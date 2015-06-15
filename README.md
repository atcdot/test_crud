	Задание
Задача заключается в следующем. Написать CRUD (create read update delete), с использованием Symfony2 Framework.

Сущности: 
User:->properties: firstName, lastName, age, email. 
Связанные сущности: 
ManyToOne: UserRoles->properties: userId, roleName etc. 
ManyToMany: UserArrdess->properties: zip, city, address (улица + номер дома). 

Интерфейс: 

1) Авторизация. 

2) Список пользователей, в таблицу выводим все данные пользователя + 3 кнопки "Профиль", "Редактировать", "Удалить" (использовать серверную пагинацию). 

3) Создание/редактирование данных пользователя. 

4) Профиль. 

Форма добавления пользователей:
firstName ( input->type=text ), lastName ( input ->type=text ), age( input ->type=number ), email (input->type=email ), userRole(select), userAddress (input) - пользователь может иметь неограниченное количество адресов, поля (zip, city, address) выстраиваются инлайн (в одну строчку). Рядом 2 кнопки "Добавить" + "Удалить". 

Реализовать валидацию как серверную силами Symfony2, так и клиентскую Jquery Validate.
