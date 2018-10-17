/**
 * aui-calendar.js
 * @author 流浪男
 * Licensed under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 */
(function( window, undefined ) {
    "use strict";
    var _weekArr = "日,一,二,三,四,五,六";
    var _calendarNumString = "一二三四五六七八九十";
    var calendarParams;
    var auiCalendar = function(params,callback) {
        calendarParams = params;
        this.init(params,callback);
    };
    auiCalendar.prototype = {
        init: function(params,callback){
            var self = this;
            var tableHtml = '';
            var startYear = new Date().getFullYear();
            var startMonth = new Date().getMonth()+1;
            // 生成日历
            if(calendarParams.lunar){
                tableHtml += '<table class="aui-calendar-lunar">';
            }else{
                tableHtml += '<table>';
            }
                tableHtml += '<thead class="aui-calendar-header">';
                tableHtml += '<tr>';
                    tableHtml += '<th colspan="2" id="aui-calendar-btn-prev"><div class="aui-calendar-btn"><i class="aui-iconfont aui-icon-left"></i></div></th>';
                    tableHtml += '<th class="aui-calendar-title" colspan="3" aui-data-year="'+startYear+'" aui-data-month="'+startMonth+'" id="aui-calendar-date">'+startYear+'年'+startMonth+'月</th>';
                    tableHtml += '<th colspan="2" id="aui-calendar-btn-next"><div class="aui-calendar-btn"><i class="aui-iconfont aui-icon-right"></i></div></th>';
                tableHtml += '</tr>';
                tableHtml += '</thead>';
                tableHtml += '<tbody class="aui-calendar-week">';
                tableHtml += '<tr data-year="'+startYear+'" data-month="'+startMonth+'">'+self._createWeek()+'</tr>';
                tableHtml += '</body>';
                tableHtml += '<tbody class="aui-calendar-body"></tbody>';
            tableHtml += '</table>';
            if(params.element.innerHTML = tableHtml){
                // _callBack();
                self._createDay(startYear,self._foo(startMonth),callback);
                document.getElementById("aui-calendar-btn-prev").addEventListener("click", function(){
                    var _d = new Date(""+startYear+"-"+self._foo(startMonth)+"");
                    startYear = _d.getFullYear();
                    startMonth = _d.getMonth()+1;
                    startMonth = startMonth-1;
                    if(startMonth == 0){
                        startYear = startYear-1;
                        startMonth = 12;
                    }
                    self._createDay(startYear,self._foo(startMonth),callback);
                    document.getElementById("aui-calendar-date").textContent = startYear+"年"+startMonth+"月";
                })
                document.getElementById("aui-calendar-btn-next").addEventListener("click", function(){
                    var _d = new Date(""+startYear+"-"+self._foo(startMonth)+"");
                    startYear = _d.getFullYear();
                    startMonth = _d.getMonth()+1;
                    startMonth = startMonth+1;
                    if(startMonth == 13){
                        startYear = startYear+1;
                        startMonth = 1;
                    }
                    self._createDay(startYear,self._foo(startMonth),callback);
                    document.getElementById("aui-calendar-date").textContent = startYear+"年"+startMonth+"月";
                })
            }
        },
        _createDay: function(year,month,callback) {
            var self = this;
            var html = '',
                s = 0,
                d = 1,
                _d = 1;
            var firstDay = self._getFirstDay(year,month);
            var monthLen = self._getMonthLen(year,month);
            for (var row = 0; row < 6; row++){
                html += '<tr>';
                    for (var col = 0; col < 7; col++) {
                        if(s >= firstDay && d <= monthLen){
                            html += '<td date="'+year+'-'+self._foo(month)+'-'+self._foo(d)+'" class="aui-calendar-day" style="color:#787c80">';
                            html += '<div class="aui-calendar-day-item">';
                            // 判断是否为今天
                            html += d;
                            // 农历
                            if(calendarParams.lunar){
                                html += '<p>'+self._getLunarDay(''+year+'-'+self._foo(month)+'-'+self._foo(d)+'')+'</p>';
                            }

                            html += '</div>';
                            if(self._getToday(year,month,d)){
                                html += '<div class="today"></div>';
                            }
                            d++;
                        }else{
                            html += '<td>';
                        }
                        html += '</td>';
                        s++;
                    }
                html += '</tr>';
                firstDay = firstDay+row;
            }
            document.querySelector(".aui-calendar-body").innerHTML = html;
            var ret = {};
            var tdList = document.querySelectorAll("tbody td");
            for (var i = 0; i < tdList.length; i++) {
                if(tdList[i].getAttribute('date')){
                    tdList[i].addEventListener('click',function(e){
                        if(document.querySelector("td.aui-active"))document.querySelector("td.aui-active").classList.remove("aui-active");
                        this.classList.add("aui-active");
                        var clickStatus = this.getAttribute("click-status");
                        if(clickStatus == 'false'){
                            return;
                        }
                        if(document.querySelector("td .active")){
                            var activeDom = document.querySelector("td .active");
                            activeDom.parentNode.removeChild(activeDom);
                        }
                        this.insertAdjacentHTML('beforeend', '<div class="active"></div>');
                        ret['status'] = 'success';
                        ret['date'] = this.getAttribute('date');
                        // console.log(ret);
                        callback(ret)
                    })
                }
            }
        },
        _createWeek: function(){
            var html = '';
            var week = _weekArr.split(',');
            for (var i = 0; i < week.length; i++) {
                html += '<th class="aui-calendar-day"  style="width:14.2857%; color:#596066;">';
                html += week[i];
                html += '</th>';
            }
            return html;
        },
        // 月份为一位时自动补全0
        _foo : function(str){
            str ='0'+str;
            return str.substring(str.length-2,str.length);
        },
        // 获取当月天数
        _getMonthLen : function (year,month){
            month = parseInt(month, 10);
            var monthLen = new Date(year, month, 0);
            return monthLen.getDate();
        },
        // 获取今天日期 todayDate未定义？？？
        _getToday : function(year,month,date){
            // if(year == todayDate.getFullYear() && month == todayDate.getMonth()+1 && date == todayDate.getDate()){
            //     return true;
            // }else {
            //     return false;
            // }

        },
        // 获取月第一天
        _getFirstDay : function(year,month){ //获取每个月第一天再星期几，月份减一
            month = parseInt(month, 10)-1;
            var firstDay = new Date(year,month,1);
            return firstDay.getDay();
        },
    };
	window.auiCalendar = auiCalendar;
})(window);
