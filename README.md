1.เปิด xampp กดปุ่ม start ตรง Apache และ MySQL
2.นำไฟล์ sql ชื่อ bangkoktest.sql ที่แนบไปให้ ลงใน mysql โดยสร้างชื่อ db ว่า bangkoktest
3.เข้าโฟลเดอร์ตามลำดับนี้ ไดรฟ์ C > xampp > htdocs
4.เปิด cmd จากโฟลเดอร์  htdocs พิมพ์คำสั่งนี้ git clone https://github.com/prinza16/pretest.git
5.จากนั้นพิมพ์คำสั่งใน cmd เดิมดังนี้ cd pretest จากนั้นพิมพ์คำสั่งนี้ code . เพื่อเปิด vscode
6.เปิด terminal พิมพ์คำสั่ง composer install
7.เปลี่ยนชื่อไฟล์ .env.example เป็น .env และพิมพ์คำสั่งที่ Terminal ด้วยคำสั่งนี้ php artisan key:generate
8.รัน server ด้วยคำสั่ง php artisan serve
