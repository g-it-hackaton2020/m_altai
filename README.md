# Проект открытого общества

Используеться php и symphony
Для развертывания проекта необходимо выполнить 

```compores install```

Для управления ресурсами css\js используеться yarn
Для установки ресурсов необходимо выполнить 
```yarn install```

После клонирования репозитория необходимо прописать параметры подключения к базе данных в файле ```.env``` и выполнить
```
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```