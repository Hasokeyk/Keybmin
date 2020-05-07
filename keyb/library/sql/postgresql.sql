CREATE SEQUENCE kb_auth_id_seq;
CREATE TABLE kb_auth (
    id SERIAL PRIMARY KEY,
    authName varchar(255) NOT NULL,
    authDesc text NOT NULL,
    parentID int DEFAULT '0'
);
ALTER SEQUENCE kb_auth_id_seq OWNED BY kb_auth.id;

CREATE SEQUENCE kb_pages_id_seq;
CREATE TABLE kb_pages (
    id SERIAL PRIMARY KEY,
    title varchar(255) NOT NULL,
    description varchar(522) NOT NULL,
    link varchar(255) NOT NULL,
    template text NOT NULL,
    shortcode varchar(255) NOT NULL,
    status int NOT NULL DEFAULT '1',
    control int NOT NULL DEFAULT '1',
    menu int NOT NULL DEFAULT '1',
    type varchar(255) NOT NULL DEFAULT 'pages',
    iconClass varchar(255) NOT NULL DEFAULT 'fab fa-korvue',
    userAuth text NOT NULL,
    time int NOT NULL,
    parentID int NOT NULL DEFAULT '0',
    orderBy int DEFAULT '0'
);
ALTER SEQUENCE kb_pages_id_seq OWNED BY kb_pages.id;

CREATE SEQUENCE kb_settings_id_seq;
CREATE TABLE kb_settings (
    id SERIAL PRIMARY KEY,
    var varchar(255) NOT NULL,
    val varchar(255) NOT NULL
);
ALTER SEQUENCE kb_settings_id_seq OWNED BY kb_settings.id;

CREATE SEQUENCE kb_users_id_seq;
CREATE TABLE kb_users (
    id SERIAL PRIMARY KEY,
    fullName varchar(255) NOT NULL,
    mail varchar(255) NOT NULL,
    phone varchar(255) NOT NULL,
    password varchar(255) NOT NULL,
    status int NOT NULL DEFAULT '1',
    session text,
    authID int NOT NULL,
    time int NOT NULL
);
ALTER SEQUENCE kb_users_id_seq OWNED BY kb_users.id;

INSERT INTO kb_auth (id, authName, authDesc, parentID) VALUES
(1, 'Super Admin', 'Super Admin Desc', 0),
(2, 'Admin', 'Admin Desc', 0),
(3, 'User', 'User Desc', 0);

INSERT INTO kb_settings (id, var, val) VALUES
(1, 'theme', 'default'),
(2, 'logo', 'keybmin-logo.jpg'),
(3, 'lang', 'tr_TR'),
(4, 'siteUrl', '/');

INSERT INTO kb_users (id, fullName, mail, phone, password, status, session, authID, time) VALUES
(1, 'Hasan Yüksektepe', 'admin@localhost', '905414233558', '21232f297a57a5a743894a0e4a801fc3', 1, '', 1, 1528843544);

INSERT INTO kb_pages (id, title, description, link, template, shortcode, status, control, menu, type, iconClass, userAuth, time, parentID, orderBy) VALUES
(1, 'Keybmin', 'Keybmin Desc', '?page=keybmin', 'keybmin', 'keybmin', 1, 1, 1, 'keybmin', 'fab fa-korvue', '[1]', 1583855834, 0, 9999999),
(2, 'Page Operations', 'Page Operations Desc', '?page=keybmin-page-operations', 'keybmin-page-operations', 'keybmin-page-operations', 1, 1, 1, 'keybmin', 'fas fa-file-powerpoint', '[1]', 1528843544, 1, 0),
(3, 'Page List', 'Page List Desc', '?page=keybmin-page-operations-page-list', 'keybmin-page-operations-page-list', 'keybmin-page-operations-page-list', 1, 1, 1, 'keybmin', 'fab fa-korvue', '[1]', 1528843544, 2, 0),
(4, 'Page Edit', 'Page Edit Desc', '?page=keybmin-page-operations-page-edit', 'keybmin-page-operations-page-edit', 'keybmin-page-operations-page-edit', 1, 1, 2, 'keybmin', 'fas fa-file-medical', '["1","2","3"]', 1528843544, 2, 0),
(5, 'Add New Page', 'Add New Page Desc', '?page=keybmin-page-operations-add-new-page', 'keybmin-page-operations-add-new-page', 'keybmin-page-operations-add-new-page', 1, 1, 1, 'keybmin', 'fas fa-file-medical', '[1]', 1528843544, 2, 0),
(6, 'Auth Operations', 'Auth Operations Desc', '?page=keybmin-auth-operations', 'keybmin-auth-operations', 'keybmin-auth-operations', 1, 1, 1, 'keybmin', 'fas fa-align-center', '[1]', 1528843544, 1, 0),
(7, 'Auth List', 'Auth List Desc', '?page=keybmin-auth-operations-auth-list', 'keybmin-auth-operations-auth-list', 'keybmin-auth-operations-auth-list', 1, 1, 1, 'keybmin', 'fas fa-list-ul', '[1]', 1528843544, 6, 0),
(8, 'Auth Edit', 'Auth Edit Desc', '?page=keybmin-auth-operations-auth-edit', 'keybmin-auth-operations-auth-edit', 'keybmin-auth-operations-auth-edit', 1, 1, 2, 'keybmin', 'fas fa-file-medical', '["1","2","3"]', 1528843544, 6, 0),
(9, 'Add New Auth', 'Add New Auth Desc', '?page=keybmin-auth-operations-add-new-auth', 'keybmin-auth-operations-add-new-auth', 'keybmin-auth-operations-add-new-auth', 1, 1, 1, 'keybmin', 'fas fa-file-medical', '[1]', 1528843544, 6, 0),
(10, 'Login', 'Login Desc', '?page=login', 'login', 'login', 1, 0, 2, 'pages', 'fab fa-korvue', '["1"]', 1528843544, 0, 0),
(11, 'Register', 'Register Desc', '?page=register', 'register', 'register', 1, 0, 2, 'pages', 'fab fa-korvue', '["1"]', 1528843544, 0, 0),
(12, 'Ajax Login', 'Ajax Login Desc', '?page=ajax-login', 'ajax-login', 'ajax-login', 1, 0, 2, 'ajax', 'fab fa-korvue', '["1"]', 1528843544, 0, 0),
(13, 'Dashboard', 'Dashboard Desc', '?page=dashboard', 'dashboard', 'dashboard', 1, 1, 1, 'pages', 'fas fa-home', '["1","2","3"]', 1528843544, 0, 0),
(14, 'Logout', 'Logout Desc', '?page=logout', 'logout', 'logout', 1, 1, 1, 'pages', 'fas fa-sign-out-alt', '["2","3","1"]', 1583859680, 0, 9999998),
(15, 'Banned', 'Banned Desc', '?page=banned', 'banned', 'banned', 1, 1, 2, 'pages', 'fas fa-ban', '["2","3","1"]', 1583859798, 0, 0),
(16, '404', '404 Desc', '?page=404', '404', '404', 1, 1, 2, 'pages', 'empty', '["2","3","1"]', 1583859793, 0, 0),
(17, '500', '500 Desc', '?page=500', '500', '500', 1, 0, 2, 'pages', 'fab fa-korvue', '["1","2","3"]', 1528843544, 0, 0),
(18, 'Users', 'Users Desc', '?page=users', 'users', 'users', 1, 1, 1, 'pages', 'fas fa-users', '["2","1"]', 1583855761, 0, 0),
(19, 'User List', 'User List Desc', '?page=users-user-list', 'users-user-list', 'users-user-list', 1, 1, 1, 'pages', 'fas fa-list', '["2","1"]', 1583859720, 18, 0),
(20, 'User Edit', 'User Edit', '?page=users-user-edit', 'users-user-edit', 'users-user-edit', 1, 1, 2, 'pages', 'fab fa-korvue', '["2","1"]', 1583857069, 18, 0),
(21, 'Add New User', 'Add New User Desc', '?page=users-add-new-user', 'users-add-new-user', 'users-add-new-user', 1, 1, 1, 'pages', 'fas fa-user-plus', '["2","1"]', 1583859731, 18, 0),
(22, 'Settings', 'Settings Desc', '?page=settings', 'settings', 'settings', 1, 1, 1, 'pages', 'fas fa-cogs', '["2","3","1"]', 1583859834, 0, 0),
(23, 'Panel Settings', 'Panel Settings', '?page=settings-panel-settings', 'settings-panel-settings', 'settings-panel-settings', 1, 1, 1, 'pages', 'fas fa-cog', '["2","1"]', 1583859828, 22, 0),
(24, 'My profile', 'My profile', '?page=settings-my-profile', 'settings-my-profile', 'settings-my-profile', 1, 1, 1, 'pages', 'fas fa-user-circle', '["2","3","1"]', 1583859816, 22, 0);