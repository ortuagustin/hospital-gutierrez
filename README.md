# Proyecto de Software - Cursada 2017

### Hospital Gutiérrez - Consultorio del Niño Sano

### Trabajo de promoción

Aplicación web desarrollada para el Hospital Gutiérrez

Entre sus características, se encuentran:

  1. Administrar los **usuarios** que acceden al sistema. Se pueden definir niveles de acceso personalizados utilizando un esquema de **roles** y **permisos** que se asignan a los diferentes usuarios  
  2. Administrar los **pacientes** del hospital
  3. Administrar las **historias clínicas** de los pacientes
  4. **Reportes gráficos** de los pacientes, basados en los controles clínicos:
		- Curva de crecimiento
		- Curva de talla
		- Curva de percentil perímetro cefálico
  5.  **Gráficos estadísticos** de los pacientes, de acuerdo a sus datos demográficos
  6. Las curvas y los gráficos se pueden **exportar a PDF**
  7. Ofrece una API RESTful para administrar **turnos médicos**
  8. Posee integración con [Telegram](https://telegram.org/), a través de un [bot](https://core.telegram.org/bots), para **consultar** y **reservar** turnos médicos

### Características técnicas

1. Aplicación web [PHP](http://php.net/) **versión 5.6.30**
2. Desarrollada con el framework [Laravel](https://laravel.com/) **versión 5.4**
3. **Independiente de la base de datos**: gracias a la abstracción brindada por el framework, se puede configurar para utilizar cualquiera de las [bases de datos soportadas por Laravel](https://laravel.com/docs/5.4/database#introduction)

#### Demo

Ésta aplicación fue desplegada a la plataforma [Heroku](http://heroku.com), podés verla siguiendo [este link](https://ortu-agustin-proyecto.herokuapp.com/). Esta precargada con algunos datos ficticios para poder probar la aplicación.
