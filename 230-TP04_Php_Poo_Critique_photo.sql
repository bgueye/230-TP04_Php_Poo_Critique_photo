#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: users
#------------------------------------------------------------

CREATE TABLE users(
        id_user Int  Auto_increment  NOT NULL ,
        login   Varchar (50) NOT NULL ,
        psw     Varchar (255) NOT NULL ,
        pseudo  Varchar (50) NOT NULL ,
        roles   Varchar (50) NOT NULL
	,CONSTRAINT users_PK PRIMARY KEY (id_user)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: photos
#------------------------------------------------------------

CREATE TABLE photos(
        id_photo    Int  Auto_increment  NOT NULL ,
        title_photo Varchar (50) NOT NULL ,
        name_file   Varchar (50) NOT NULL ,
        post_at     Date NOT NULL ,
        publication Bool NOT NULL ,
        id_user     Int NOT NULL
	,CONSTRAINT photos_PK PRIMARY KEY (id_photo)

	,CONSTRAINT photos_users_FK FOREIGN KEY (id_user) REFERENCES users(id_user)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: comments
#------------------------------------------------------------

CREATE TABLE comments(
        id_comment Int  Auto_increment  NOT NULL ,
        comment    Varchar (50) NOT NULL ,
        create_at  Date NOT NULL ,
        visible    Bool NOT NULL ,
        id_user    Int NOT NULL ,
        id_photo   Int NOT NULL
	,CONSTRAINT comments_PK PRIMARY KEY (id_comment)

	,CONSTRAINT comments_users_FK FOREIGN KEY (id_user) REFERENCES users(id_user)
	,CONSTRAINT comments_photos0_FK FOREIGN KEY (id_photo) REFERENCES photos(id_photo)
)ENGINE=InnoDB;

