# pistar-nbtc
### Install
```sh
rpi-rw
sudo su
cd /var/www/dashboard
git clone https://github.com/mrnonaki/pistar-nbtc.git
chmod 777 /var/www/dashboard/pistar-nbtc/db
rpi-ro
```
### Add REF087, E24DA-DK
```sh
rpi-rw
sudo su
echo -e "REF087\tref087.dstargateway.org\tL" >> /root/DPlus_Hosts.txt
echo -e "E24DA\te24da.dynu.com\tL" >> /root/DPlus_Hosts.txt
echo -e "E24DB\te24db.dynu.com\tL" >> /root/DPlus_Hosts.txt
echo -e "E24DC\te24dc.dynu.com\tL" >> /root/DPlus_Hosts.txt
echo -e "E24DD\te24dd.dynu.com\tL" >> /root/DPlus_Hosts.txt
echo -e "E24DE\te24de.dynu.com\tL" >> /root/DPlus_Hosts.txt
echo -e "E24DF\te24df.dynu.com\tL" >> /root/DPlus_Hosts.txt
echo -e "E24DG\te24dg.dynu.com\tL" >> /root/DPlus_Hosts.txt
echo -e "E24DH\te24dh.dynu.com\tL" >> /root/DPlus_Hosts.txt
echo -e "E24DI\te24di.dynu.com\tL" >> /root/DPlus_Hosts.txt
echo -e "E24DJ\te24dj.dynu.com\tL" >> /root/DPlus_Hosts.txt
echo -e "E24DK\te24dk.dynu.com\tL" >> /root/DPlus_Hosts.txt
rpi-ro
sudo reboot
```
### Access page
- http://pistar-ip/pistar-nbtc
