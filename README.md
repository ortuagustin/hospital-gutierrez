# Proyecto de Software - Cursada 2017

### Hospital Gutiérrez - Consultorio del Niño Sano

### Trabajo de promoción

Aplicación web desarrollada para el Hospital Gutiérrez

Entre sus características, se encuentran:

  1. Administrar los **usuarios** que acceden al sistema; se cuenta con un esquema de **roles** y **permisos** para autorizar las diversas funcionalidades; estos respetan el patron **modulo-accion** 
  2. Administrar los **pacientes** del hospital
  3. Administrar las **historias clínicas** de los pacientes
  4. **Reportes gráficos** de los pacientes, basados en los controles clínicos:
		- Curva de crecimiento
		- Curva de talla
		- Curva de percentil perímetro cefálico
  5.  **Gráficos estadísticos** de los pacientes, de acuerdo a sus datos demográficos
  6. Las curvas y los gráficos se pueden **exportar a PDF**
  7. Ofrece una API RESTful para administrar **turnos médicos**
  8. Posee integración con [Telegram](https://telegram.org/), a través de un [bot](http://t.me/ortu_agustin_proyecto_bot), para **consultar** y **reservar** turnos médicos

### Características técnicas

1. Aplicación web [PHP](http://php.net/) **versión 5.6.30**
2. Backend desarrollado con el framework [Laravel](https://laravel.com/) **versión 5.4**
3. **Independiente de la base de datos**: gracias a la abstracción brindada por el framework, se puede configurar para utilizar cualquiera de las [bases de datos soportadas por Laravel](https://laravel.com/docs/5.4/database#introduction)
4. Frontend desarrollado con el framework [Vue](https://vuejs.org/)
5. Integracion con [Algolia](https://www.algolia.com/) para realizar búsquedas y filtros muy potentes
6. Graficas implementadas con [ChartJS](http://www.chartjs.org/)

#### Demo

Ésta aplicación fue desplegada a la plataforma [Heroku](http://heroku.com), podés verla siguiendo [este link](http://ortu-agustin-proyecto.herokuapp.com/). 

Esta precargada con algunos datos ficticios para poder probar la aplicación.

Es posible registrarse, pero existen los siguientes usuarios:

| Usuario        | Contraseña   |  Rol  |
| ------------- |:-------------:| ------:|
| admin      | admin | Admin |
| medic      | medic | Medic |
| recepcionist | recepcionist | Recepcionist |


