create database aretemo
    default character set utf8
    default collate utf8_general_ci;

use aretemo;

# Users list
create table users (
                       id int auto_increment primary key,
                       date_reg timestamp default current_timestamp,
                       email char(128) not null unique,
                       name char(64),
                       password char(128) not null
);
