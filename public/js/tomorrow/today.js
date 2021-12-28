var table = $('#pacientesTable');
table.find("tbody tr").remove();
pacientes.forEach(function (paciente) {
    if('No confirmado' == paciente['Estado'] || 'Agenda Online' == paciente['Estado']){
        nombre = paciente['Nombre_paciente'] + " " +paciente["Apellidos_paciente"]
        nr = paciente['Tratamiento_Nr']
        paciente['Celular'] = paciente['Celular'].toString()
        paciente['Celular'] = paciente['Celular'].replace(/ /g,'')
        hora = paciente['Hora_inicio'].slice(0, -3)
        profesional = paciente['Profesional'].replace(/\s/g,'%20')
        precio = new Intl.NumberFormat('es-CL', {currency: 'CLP', style: 'currency'}).format(paciente['TotalAtencion'])
        precio = precio.replace(/\s/g,'%20')
        phone = "569"+ paciente['Celular'].substr(paciente['Celular'].length - 8);
        mail = "<a href=mailto:"+paciente['Mail']+">"+paciente['Mail']+"</a>"
        texto = 'Hola '+paciente['Nombre_paciente']+'! Te recordamos que tienes atención hoy con '+profesional+' a las '+hora+' hrs.'

        texto += ' *Favor confirmar tu asistencia respondiendo este mensaje*'


        if(paciente['TotalAtencion']!=0){
            texto += '--Te recordamos que puedes pagar tu atención en el siguiente link http://yjb.cl/pago. El monto a pagar es de '+precio
        }

        if (paciente['Profesional'] == "Melissa Ross Guerra"){
            texto += '--Traer short y/o peto'
        }
        else {
            texto += '--Trae ropa cómoda'
        }

        texto += ', estamos en San pascual 736, Las Condes. Contamos con estacionamiento afuera del local.'
        texto += '--*Notar que en 2022 ajustamos precios segun variacion IPC. Cualquier duda nos puedes consultar por este medio* '

        texto = texto.replace(/\--/g,'%0A%0A')
        texto = texto.replace(/\s/g,'%20')
        whatsapp = "https://web.whatsapp.com/send?phone="+phone+"&text="+texto

        link = "<a href='"+whatsapp+"' target='_blank'>+"+phone+"</a><br><a href='/pdf/"+nr+"' target='_blank'>Permiso PDF</pdf></a>"
        table.append("<tr><td>" + nombre + "</td><td>" + mail +  "</td><td>"  + link + "</td></tr>");
    }
});
$('td a').click(function(){
    $(this).parent().parent().addClass('bg-warning')
});
