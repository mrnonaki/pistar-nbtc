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
### Add REF087, E24DA-DJ
```sh
rpi-rw
sudo su
echo -e "REF087\tref087.dstargateway.org\tL" >> /root/DPlus_Hosts.txt
echo -e "E24DA\te24da.dstargateway.org\tL" >> /root/DPlus_Hosts.txt
echo -e "E24DB\te24db.dstargateway.org\tL" >> /root/DPlus_Hosts.txt
echo -e "E24DC\te24dc.dstargateway.org\tL" >> /root/DPlus_Hosts.txt
echo -e "E24DD\te24dd.dstargateway.org\tL" >> /root/DPlus_Hosts.txt
echo -e "E24DE\te24de.dstargateway.org\tL" >> /root/DPlus_Hosts.txt
echo -e "E24DF\te24df.dstargateway.org\tL" >> /root/DPlus_Hosts.txt
echo -e "E24DG\te24dg.dstargateway.org\tL" >> /root/DPlus_Hosts.txt
echo -e "E24DH\te24dh.dstargateway.org\tL" >> /root/DPlus_Hosts.txt
echo -e "E24DI\te24di.dstargateway.org\tL" >> /root/DPlus_Hosts.txt
echo -e "E24DJ\te24dj.dstargateway.org\tL" >> /root/DPlus_Hosts.txt
exit
rpi-ro
sudo reboot

```
### Access page
- (for HDMI) http://pistar-ip/pistar-nbtc
- (for Mobile) http://pistar-ip/pistar-nbtc/mobile
