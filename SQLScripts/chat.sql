create table managelanka.chat_messages
(
    id          int auto_increment
        primary key,
    sender_id   varchar(20) not null,
    receiver_id varchar(20) null,
    body        longtext    null,
    timestamp   datetime    null
);

