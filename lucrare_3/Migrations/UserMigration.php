<?php

class UserMigration {
    public function action() {
        $mysql = new mysqli('localhost', 'user','', 'admin');
        $query = [];
        if($mysql) {
            $query[] = "DROP TABLE if exists user";
            $query[] = "Create TABLE if not exists user(id int not null auto_increment, name varchar(255) not null, firma varchar(255), email varchar(255) not null, tara varchar(255), primary key(id))";
            $query[] = "INSERT into user(name, email, firma, tara) values ('Eugeniu', 'eugeniu@dell.md', 'Dell', 'Moldova')";
            $query[] = "INSERT into user(name, email, firma, tara) values ('Ion', 'ion@apple.md', 'Apple', 'Moldova')";
            $query[] = "INSERT into user(name, email, firma, tara) values ('Alex', 'alex@microsoft.md', 'Microsoft', 'Moldova')";
            $query[] = "INSERT into user(name, email, firma, tara) values ('John', 'John@play.md', 'PlayBoy', 'Moldova')";
            $query[] = "INSERT into user(name, email, firma, tara) values ('Barista', 'coffee@coffee.md', 'Coffee-Maker', 'Moldova')";
            $query[] = "INSERT into user(name, email, firma, tara) values ('Valeria', 'valeria@public.md', 'self-employed', 'Moldova')";
            $query[] = "INSERT into user(name, email, firma, tara) values ('Admin', 'admin@localhost', '', 'Moldova')";
            $query[] = "INSERT into user(name, email, firma, tara) values ('Test user', 'test@user.md', 'Echipa de testare', 'Moldova')";
            $query[] = "INSERT into user(name, email, firma, tara) values ('Test user', 'test@user.md', 'Echipa de testare', 'Moldova')";
            $query[] = "INSERT into user(name, email, firma, tara) values ('Test user', 'test@user.md', 'Echipa de testare', 'Moldova')";
            $query[] = "INSERT into user(name, email, firma, tara) values ('Test user', 'test@user.md', 'Echipa de testare', 'Moldova')";
            $query[] = "INSERT into user(name, email, firma, tara) values ('Test user', 'test@user.md', 'Echipa de testare', 'Moldova')";
            $query[] = "INSERT into user(name, email, firma, tara) values ('Test user', 'test@user.md', 'Echipa de testare', 'Moldova')";
            $query[] = "INSERT into user(name, email, firma, tara) values ('Test user', 'test@user.md', 'Echipa de testare', 'Moldova')";
            $query[] = "INSERT into user(name, email, firma, tara) values ('Test user', 'test@user.md', 'Echipa de testare', 'Moldova')";
            $query[] = "INSERT into user(name, email, firma, tara) values ('Test user', 'test@user.md', 'Echipa de testare', 'Moldova')";
            $query[] = "INSERT into user(name, email, firma, tara) values ('Test user', 'test@user.md', 'Echipa de testare', 'Moldova')";
            $query[] = "INSERT into user(name, email, firma, tara) values ('Test user', 'test@user.md', 'Echipa de testare', 'Moldova')";
            $query[] = "INSERT into user(name, email, firma, tara) values ('Test user', 'test@user.md', 'Echipa de testare', 'Moldova')";
            $query[] = "INSERT into user(name, email, firma, tara) values ('Test user', 'test@user.md', 'Echipa de testare', 'Moldova')";
            $query[] = "INSERT into user(name, email, firma, tara) values ('Test user', 'test@user.md', 'Echipa de testare', 'Moldova')";
            $query[] = "INSERT into user(name, email, firma, tara) values ('Test user', 'test@user.md', 'Echipa de testare', 'Moldova')";
            $query[] = "INSERT into user(name, email, firma, tara) values ('Test user', 'test@user.md', 'Echipa de testare', 'Moldova')";
            $query[] = "INSERT into user(name, email, firma, tara) values ('Test user', 'test@user.md', 'Echipa de testare', 'Moldova')";
            $query[] = "INSERT into user(name, email, firma, tara) values ('Test user', 'test@user.md', 'Echipa de testare', 'Moldova')";
            $query[] = "INSERT into user(name, email, firma, tara) values ('Test user', 'test@user.md', 'Echipa de testare', 'Moldova')";
            $query[] = "INSERT into user(name, email, firma, tara) values ('Test user', 'test@user.md', 'Echipa de testare', 'Moldova')";
            $query[] = "INSERT into user(name, email, firma, tara) values ('Test user', 'test@user.md', 'Echipa de testare', 'Moldova')";
            $query[] = "INSERT into user(name, email, firma, tara) values ('Test user', 'test@user.md', 'Echipa de testare', 'Moldova')";
            $query[] = "INSERT into user(name, email, firma, tara) values ('Test user', 'test@user.md', 'Echipa de testare', 'Moldova')";
            $query[] = "INSERT into user(name, email, firma, tara) values ('Test user', 'test@user.md', 'Echipa de testare', 'Moldova')";
            $query[] = "INSERT into user(name, email, firma, tara) values ('Test user', 'test@user.md', 'Echipa de testare', 'Moldova')";
            $query[] = "INSERT into user(name, email, firma, tara) values ('Test user', 'test@user.md', 'Echipa de testare', 'Moldova')";
            $query[] = "INSERT into user(name, email, firma, tara) values ('Test user', 'test@user.md', 'Echipa de testare', 'Moldova')";
            $query[] = "INSERT into user(name, email, firma, tara) values ('Test user', 'test@user.md', 'Echipa de testare', 'Moldova')";
            $query[] = "INSERT into user(name, email, firma, tara) values ('Test user', 'test@user.md', 'Echipa de testare', 'Moldova')";
            $query[] = "INSERT into user(name, email, firma, tara) values ('Test user', 'test@user.md', 'Echipa de testare', 'Moldova')";
            $query[] = "INSERT into user(name, email, firma, tara) values ('Test user', 'test@user.md', 'Echipa de testare', 'Moldova')";
            $query[] = "INSERT into user(name, email, firma, tara) values ('Test user', 'test@user.md', 'Echipa de testare', 'Moldova')";
            $query[] = "INSERT into user(name, email, firma, tara) values ('Test user', 'test@user.md', 'Echipa de testare', 'Moldova')";
            $query[] = "INSERT into user(name, email, firma, tara) values ('Test user', 'test@user.md', 'Echipa de testare', 'Moldova')";
            $query[] = "INSERT into user(name, email, firma, tara) values ('Test user', 'test@user.md', 'Echipa de testare', 'Moldova')";
            $query[] = "INSERT into user(name, email, firma, tara) values ('Test user', 'test@user.md', 'Echipa de testare', 'Moldova')";
            $query[] = "INSERT into user(name, email, firma, tara) values ('Test user', 'test@user.md', 'Echipa de testare', 'Moldova')";
            $query[] = "INSERT into user(name, email, firma, tara) values ('Test user', 'test@user.md', 'Echipa de testare', 'Moldova')";
            $query[] = "INSERT into user(name, email, firma, tara) values ('Test user', 'test@user.md', 'Echipa de testare', 'Moldova')";
            $query[] = "INSERT into user(name, email, firma, tara) values ('Test user', 'test@user.md', 'Echipa de testare', 'Moldova')";

            foreach($query as $stmt) {
                $mysql->query($stmt);
            }
            $mysql->close();
        }
    }
}