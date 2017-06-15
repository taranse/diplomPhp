# Дипломная работа по курсу PHP-8
<a href="http://netology.ru/programs/php-sql">«PHP/SQL: back-end разработка и базы данных»</a>
<h3>Типовой сервис вопросов и ответов</h3>


<h4>1. Запуск проекта</h4>
Дамб базы данных лежит в файле <strong>database/faq.sql</strong>
<p>
 Для правильной работы требуется установить materialize. Для этого выполнить команду <code>bower install</code>
</p>
<p>
Для запуска проекта ввести в консоль <code>php artisan serve</code>
</p>
Базу данных можно сгенерировать с нуля:
<pre>
php artisan migrate
php artisan db:seed
</pre>

<h4>2. Логирование</h4>

Логирование файла проходит в файле <strong>storage/logs/laravel.log</strong> <br>
имеет вид:
<pre>
[2017-06-15 08:08:20] local.INFO: Администратор admin создал рубрику "Вопросы по php  2" (3)  
</pre>
