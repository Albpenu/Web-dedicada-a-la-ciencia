insert into categorias values ('', 'Aspirante a investigador', 'Para usuarios iniciados en esto de las movidas científicas',now());
insert into categorias values ('', 'Investigador auxiliar', 'Para usuarios que pilotan de ciencia',now());
insert into categorias values ('', 'Investigador titular', 'Sólo apta para usuarios duchos, sabios o eminentes; incluso pedantes ;)',now());	

truncate categorias;

/*insert into usuarios values (NULL, 'Hawking1996', md5('1234'), '');
insert into usuarios values (NULL, 'TeslaCharger98', 'Usuario  ciencia');
insert into usuarios values (NULL, 'MarieCurieTodoNobels', '');
insert into usuarios values (NULL, 'NewtonOrOldton', '');*/
/* docker runn -it -d -p 8080 -p 3316:3306 */
insert into posts values (NULL, NULL, NULL, '', '', '', '', '');
insert into posts values (NULL, NULL, NULL, '', '', '', '', '');
insert into posts values (NULL, NULL, NULL, '', '', '', '', '');
insert into posts values (NULL, NULL, NULL, '', '', '', '', '');

insert into subcategorias values (NULL, NULL,'', '');
insert into subcategorias values (NULL, NULL,'', '');
insert into subcategorias values (NULL, NULL,'', '');
insert into subcategorias values (NULL, NULL,'', '');

insert into votos values (NULL, '', NULL, NULL);
insert into votos values (NULL, '', NULL, NULL);
insert into votos values (NULL, '', NULL, NULL);
insert into votos values (NULL, '', NULL, NULL);