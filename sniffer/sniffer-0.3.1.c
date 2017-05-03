


/* TODO:
*	mysql stderr stdout to file
*/


#include <stdio.h>
#include <string.h>
#include <unistd.h>
#include <fcntl.h>
#include <errno.h>
#include <stdlib.h>
#include <termios.h>
#include <ctype.h>
#include <mysql.h>


#define MAX 500
#define MAX_SQL 700

int main(int argc, char *argv[]) {
    int sd = 3;
    char *serialPort = "";
    char valor[MAX] = "";
    char c;
    struct termios ops;
    char sql[MAX_SQL] = "";
    MYSQL mysql;

    //Sintax test
    if (argc != 3) {
        fprintf(stderr, "Usage: %s port mysql_server_ip (%s /dev/ttyUSB0 localhost)\n", argv[0], argv[0]);
        exit(0);
    }
    //Port entered test
    if (strcmp(argv[1], "/dev/ttyS0") || strcmp(argv[1], "/dev/ttyS1") || strcmp(argv[1], "/dev/ttyUSB0") || strcmp(argv[1], "/dev/ttyUSB1"))
	serialPort=argv[1]; 
   else {
        fprintf(stderr, "Choose a valid port (/dev/tty[S0|S1|USB0|USB1])\n");
	printf ("%s", argv[1]);
        exit(0);
    }
    //Try to open port
    if ((sd = open(serialPort, O_RDWR | O_NOCTTY | O_NDELAY)) == -1) {
        fprintf(stderr, "Unable to open the serial port %s - \n", serialPort);
        exit(-1);
    } else {
        if (!sd) {
            sd = open(serialPort, O_RDWR | O_NOCTTY | O_NDELAY);
        }
        fcntl(sd, F_SETFL, 0);
    }
    //Set terminal options
    tcgetattr(sd, &ops);
    //Set terminal speed
    cfsetispeed(&ops, B38400);
    cfsetospeed(&ops, B38400);
    ops.c_cflag |= (CLOCAL | CREAD);
    //No parity
    ops.c_cflag &= ~PARENB;
    ops.c_cflag &= ~CSTOPB;
    ops.c_cflag &= ~CSIZE;
    ops.c_cflag |= CS8;
    //raw input: ready to receive
    ops.c_lflag &= ~(ICANON | ECHO | ECHOE | ISIG);
    //Ignore parity errors
    ops.c_iflag |= ~(INPCK | ISTRIP | PARMRK);
    ops.c_iflag |= IGNPAR;
    ops.c_iflag &= ~(IXON | IXOFF | IXANY | IGNCR | IGNBRK);
    ops.c_iflag |= BRKINT;
    //raw output: ready to transmit
    ops.c_oflag &= ~OPOST;
    //apply
    tcsetattr(sd, TCSANOW, &ops);

    //Connect to Database
    mysql_init(&mysql);
    mysql_options(&mysql, MYSQL_READ_DEFAULT_GROUP, "waspmon");
    if (!mysql_real_connect(&mysql, argv[2], "waspmon", "waspmon", "waspmon", 0, NULL, 0)) {
        fprintf(stderr, "Failed to connect to database: Error: %s\n", mysql_error(&mysql));
        exit(-1);
    } else {
        fprintf(stdout, "Connected to database\n");
    }

    //Set variables to load from sensor values from stream
    int j = 0;
    int ret;
    char h1[50];
    char wasp_id[50];
    char sensor[50];
    int bat_level;
    char temp_int[50];
    int r_val;
    char accx[50];
    char accy[50];
    char accz[50];   

    while (1) {

        read(sd, &c, 1);
        valor[j] = c;
        j++;
       
	if ((c == '\n') || (j == (MAX - 1))) {
            valor[j] = '\0';
	    ret = sscanf(valor, "%[^#]#%[^#]#id_%[^#]#%d#%[^#]#%d#%[^#]#%[^#]#%[^#]#", &h1[0], &sensor[0], &wasp_id[0], &bat_level, &temp_int[0], &r_val, &accx[0], &accy[0], &accz[0]);
	   if (ret == 9) {
                //fprintf(stdout, "\nWasp id: %s\nBat level: %d\nTemp: %s\nAcell reg:%d Coord: %s: %s: %s\n\n", wasp_id, bat_level, temp_int, r_val, accx, accy, accz);
           	// Create SQL insertion string.
                sprintf(sql, "insert into wasp_data values(NULL,now(),'%s','%d','%s','%s','%s','%s');", wasp_id, bat_level, temp_int, accx, accy, accz);
                if (mysql_query(&mysql, sql) != 0) {
                    fprintf(stderr, "Insert Failed:%s\n", sql);
                } else {
                    fprintf(stdout, "Insert Succeeded:%s\n", sql);
                }

            } else {
                fprintf(stderr, "\nFrame: %s\n", valor);
		fprintf(stderr, "\nWasp id: %s\nBat level: %d\nTemp: %s\nAcell reg:%d Coord: %s: %s: %s\n\n", wasp_id, bat_level, temp_int, r_val, accx, accy, accz);
                fprintf(stderr, "\nBad frame received\n");
            }
            j = 0;
            valor[j] = '\0';
        }
    }
    mysql_close(&mysql);
    close(sd);
   exit(0);
}
