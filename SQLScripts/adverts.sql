create table managelanka.adverts
(
    id           int auto_increment
        primary key,
    location     varchar(200) null,
    grace_period date         null,
    amount       int          null,
    price        int          null,
    type         varchar(20)  null,
    rep_id  varchar(20)  not null
);
