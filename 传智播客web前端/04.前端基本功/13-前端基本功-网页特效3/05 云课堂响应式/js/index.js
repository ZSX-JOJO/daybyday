/**
 * Created by Administrator on 2015/10/16.
 */
$(document).ready(function(){

    /*�����ť*/

    $(".line").on("click",function(){

         $(this).toggleClass("toggle").siblings(".nav1").toggle();
    })
    $(".user").on("click",function(){
        $(".user-btn").toggleClass("move");
    })
    var slide = $(".slide");  // ��ȡ�����ĺ���
    var discLi = $(".disc li");
    var slideLi = $(".slide li");
    var W = $(window).width();  // ��ȡ��Ļ�Ŀ��
    //��¡һ��ͼƬ
    slide.append(slideLi.eq(0).clone(true));
    /* discLi.on({
         "mouseenter":function(){ alert(11);},
         "click":function(){alert(22);}
     })
     �¼�ί��   ����¼�*/
    $(".slide li").width(W);  // ����Ļ�Ŀ�ȸ� ������  li
    var key = 0; // ͼƬ������
    var circle = 0; //СԲ���
    discLi.on("click",function(){
        /*alert($(this).index());*/
       /* �����n���� ��slide��Ҫ��n��Ļ*/
       circle =  key = $(this).index();// �ѵ�ǰ����Ÿ� key
        run();
        disc();
    })

    /*�˶�����*/
    function run(){
        slide.stop().animate({"left":-key * W},500);
    }

    /*СԲ�㺯��*/
    function disc(){
        discLi.eq(circle).addClass("current").siblings().removeClass();
    }

    /*��Ӷ�ʱ��*/
    var timer = 0;

    timer = setInterval(autoplay,3000);

    //�Զ����ź���
    function autoplay(){
        //�ȿ�ͼƬ
        key++;
        if(key > slideLi.length)
        {
            slide.css("left",0);  //css ����ص���һ��
            key = 1; // �����ڶ���
        }
        run();
        //�ٿ�СԲ��
        circle++;
        circle > discLi.length-1 ? circle = 0 : circle;
        disc();
    }

    //�رն�ʱ��
    $(".banner").hover(function(){
        clearInterval(timer);
        timer = null;
    },function(){
        clearInterval(timer); // ��ס �ǳ���Ҫ�� Ҫ����ʱ���� �ȹرն�ʱ����
        timer = setInterval(autoplay,3000);
    })

    //��Ļ����
    $(window).resize(function(){
        W = $(window).width();
        $(".slide li").width(W);
    })
















})
