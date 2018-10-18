# pistar-nbtc
### Install
```sh
rpi-rw
sudo su
git clone https://github.com/mrnonaki/pistar-nbtc.git /var/www/dashboard/pistar-nbtc
chown www-data:www-data /var/www/dashboard/pistar-nbtc/db
exit
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
exit
rpi-ro
sudo reboot

```
### Access page
- (for HDMI) http://pistar-ip/pistar-nbtc
- (for Mobile) http://pistar-ip/pistar-nbtc/mobile
