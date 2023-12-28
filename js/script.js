
$(window).on('scroll',function(){
    if($(window).scrollTop()){
        $('nav').addClass('black')
    }
    else{
        $('nav').removeClass('black')
    }
});
$(".eliminar").click(function(e){
    alert("");  
    /*e.preventDefault();
      var id=$(this).attr('data-id');*/
      
  });
const ancho=window.innerWidth/2
const alto=window.innerHeight/2

let seguirinptMouse=true
$(document).ready(function(){
    $(".menu h4").click(function(){
        $("nav ul").toggleClass("active")
    })
/*ANIMACIÓN DEL FORMULARIO CON MONSTER*//*
    $('body').on('mousemove',function(e){
        if(seguirinptMouse){
            if(e.clientX< ancho && e.clientY<alto){
                monster.src="img_form/2.png"
            }else if(e.clientX< ancho && e.clientY>alto){
                monster.src="img_form/3.png"
            }else if(e.clientX > ancho && e.clientY<alto){
                    monster.src="img_form/5.png"
            }else{
                monster.src="img_form/4.png"
            }
        }

        
    })
    $('#usuario-input').on('focus',function(){
        seguirinptMouse=false
    })
    $('#usuario-input').on('blur',function(){
        seguirinptMouse=true
    })

    $('#usuario-input').on('keyup',function(){
        let usuario=$(this).val().length
        if(usuario>=0 && usuario<=5){
            monster.src='img_form/leer/1.png'
        }else if(usuario>=6 && usuario<=14){
        monster.src='img_form/leer/2.png'
        }
        else if(usuario>=14 && usuario<=20){
            monster.src='img_form/leer/3.png'
        }else{
            monster.src='img_form/leer/4.png'
        }
    })
    
    $('#clave').on('focus',function(){
        seguirinptMouse=false
        let cont=1
        const cubrirojo=setInterval(()=>{
            monster.src='img_form/password/'+cont+'.png'
            if(cont<8){
                cont++
            }else{
                clearInterval(cubrirojo)
            }
        },100)
    })
    $('#clave').on('blur',function(){
        seguirinptMouse=true
        let cont=7
        const descubrirojo=setInterval(()=>{
            monster.src='img_form/password/'+cont+'.png'
            if(cont>1){
                cont--
            }else{
                clearInterval(descubrirojo)
            }
        },100)
    })*/

    /*Control MODAL*/
    let modal = $('.modal-fondo')
    let abrir =$('.btnM')
    let cerrar =$('.cerrarM')
    let aceptar =$('.aceptarM')
    abrir.on('click',function(){
        modal.addClass('show')
    })
    cerrar.on('click',function(){
        modal.removeClass('show')
    })
    aceptar.on('click',function(){
        modal.removeClass('show')
    })

    /*CONTROLES DEL SLIDER */

   /* const slider1 = $('.sliders')
    console.log(slider1)
    var index=0
        

    function siguienteslider(){
    
        $('.sliders')[index].removeClass('activo')
        index = ( index + 1) % $('.sliders').lenght
        $('.sliders')[index].addClass('activo')
    
    }

    function atrasslider(){
        $('.sliders')[index].removeClass('activo')
        index=(index-1+$('.sliders').lenght) % $('.sliders').lenght
        $('.sliders')[index].addClass('activo')
    
    }

    $('#adelante').click(siguienteslider)
    $('#atras').click(atrasslider)*/
    


})
var posslider =1;
var posslider2 =2;
$(document).ready(function(){
    
var maxslider=$('.contenedorSLD .sliders').length
    $('#adelante').click(function(){
        
        
        posslider++;
        if(posslider<=maxslider){
            
        $('.contenedorSLD').find('.sliders.activo').next().addClass('activo').fadeIn(1000)
        $('.contenedorSLD').find('.sliders.activo').prev().removeClass('activo')
        }else{
        $('.contenedorSLD .sliders').first().addClass('activo')
        $('.contenedorSLD .sliders').last().removeClass('activo')
        posslider=1;
        }
    })

    $('#atras').click(function(){
               
        $('.contenedorSLD').find('.sliders.activo').prev().addClass('activo')
        $('.contenedorSLD').find('.sliders.activo').next().removeClass('activo')
        
        
    })
})

