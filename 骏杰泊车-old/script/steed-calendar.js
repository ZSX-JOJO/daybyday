/*
 * AUI JAVASCRIPT PLUGIN
 * 日历组件 aui-calendar
 * v 0.0.1
 * Copyright (c) 2015 auicss.com @流浪男  QQ：343757327  群：344869952
 */
(function(window){
    "use strict";
    var todayDate = new Date();
    var _weekArr = "日,一,二,三,四,五,六",
        _monthArr = new Array ('1月','2月','3月','4月','5月','6月','7月','8月','9月','10月','11月','12月');
    var calendarParams;
    var auiCalendar = function(params,callback) {
        calendarParams = params;
        this.init(params,callback);
    };
    auiCalendar.prototype = {
        init: function(params,callback){
            var self = this;
            if(!params.element || params.element == ''){
                return;
            }
            if(!params.startDate || params.startDate == ''){
                self._startDate = todayDate.getFullYear()+'-'+(todayDate.getMonth()+1);
            }else{
                self._startDate = params.startDate;
            }
            if(!params.endDate || params.endDate == ''){
                self._endDate = self._startDate;
            }else{
                self._endDate = params.endDate;
            }
            self.tableContainer = params.element;

            var tableHtml = '';
            var startDate = self._startDate.split('-');
            var startYear = parseFloat(startDate[0]);
            var startMonth = parseFloat(startDate[1]);

            var endDate = self._endDate.split('-');
            var endYear = parseFloat(endDate[0]);
            var endMonth = parseFloat(endDate[1]);
            // 判断年开始、结束
            if(startYear == endYear){
                if(startMonth > endMonth){// 当为同一年时，如果开始月大于结束月返回错误
                    return false;
                }else{
                    var yearLen = startYear;
                }
            }else if(endYear > startYear){
                var yearLen = startYear + (endYear - startYear);
            }else{
                return false;
            }
            // 生成日历
            for (var i = startYear; i <= yearLen; i++) {
                if(startYear != i){
                    startMonth = 0;
                }else {
                    startMonth = startMonth-1;
                }
                for (var ii = startMonth; ii < 12; ii++) {
                    if(endYear == i && ii >= endMonth){
                        tableHtml += '';
                    }else{
                        tableHtml += '<table>';
                            tableHtml += '<thead class="aui-calendar-header">';
                            tableHtml += '<tr>';
                                tableHtml += '<th class="aui-calendar-title calendar-title-year">'+i+'</th><th colspan="5"></th><th class="aui-calendar-title calendar-title-mon">'+_monthArr[ii]+'</th>';
                            tableHtml += '</tr>';
                            tableHtml += '<tr class="aui-calendar-week" data-year="'+i+'" data-month="'+ii+'">'+self._createWeek()+'</tr>';
                            tableHtml += '</thead>';
                            tableHtml += '<tbody class="aui-calendar-body">';
                            tableHtml += self._createDay(i,''+(ii+1)+'');
                            tableHtml += '</tbody>';
                        tableHtml += '</table>';
                    }
                }
            }
            self.tableContainer.innerHTML = tableHtml;
            self._dateActive(callback);
        },
        _dateActive:function(callback){
            var self = this;
            var tdList = document.querySelectorAll("tbody td");
            var _returnData = {};

            for (var i = 0; i < tdList.length; i++) {
                if(tdList[i].getAttribute('date')){
                    tdList[i].addEventListener('click',function(e){
                        _returnData.selectDate = '';
                        var clickStatus = this.getAttribute("click-status");
                        if(clickStatus == 'false'){
                            return;
                        }
                        var dateActives = document.querySelectorAll("td .active");
                        for(var i = 0; i<dateActives.length;i++){
							dateActives[i].parentNode.classList.remove("aui-active");
							dateActives[i].parentNode.removeChild(dateActives[i]);
						}
						this.classList.add("aui-active");
						this.insertAdjacentHTML('beforeend', '<div class="active"></div>');
						_returnData.selectDate = this.getAttribute("date");
						callback(_returnData);
                    })
                }
            }
        },
        // 创建日历天
        _createDay:function(year,month){
            var self = this;
            var html = '',s = 0,d = 1,_d = 1;
            // 开始日期有传入天时计算
            if(self._startDate.split('-').length > 2 && year == parseFloat(self._startDate.split('-')[0]) && month == parseFloat(self._startDate.split('-')[1])){
                _d = parseFloat(self._startDate.split('-')[2]);
            }
            var firstDay = self._getFirstDay(year,month);
            // 当结束日期有传入天时计算
            if(self._endDate.split('-').length > 2 && year == parseFloat(self._endDate.split('-')[0]) && month == parseFloat(self._endDate.split('-')[1])){
                var monthLen = parseFloat(self._endDate.split('-')[2]);
                if(self._getMonthLen(year,month) < monthLen){
                    monthLen =self._getMonthLen(year,month);
                }
            }else{
                var monthLen = self._getMonthLen(year,month);
            }
            for (var row = 0; row < 6; row++){
                html += '<tr>';
                    for (var col = 0; col < 7; col++) {
                        if(s >= firstDay && d <= monthLen){
                            if(_d > d & calendarParams.beforeStartDateClick == false){
                                html += '<td date="'+year+'-'+this._foo(month)+'-'+this._foo(d)+'" class="before-day" click-status="'+calendarParams.beforeStartDateClick+'">';
                            }else{
                                html += '<td date="'+year+'-'+self._foo(month)+'-'+self._foo(d)+'" class="aui-calendar-day">';
                            }

                            
                            // 判断是否为今天
                            
                            if(self._getToday(year,month,d)){
								html += '<div class="aui-calendar-day-item aui-calendar-today">';
                                html += "今天";
                            	html += '</div>';
                            }else{
								html += '<div class="aui-calendar-day-item">';
								html += d;
                            	html += '</div>';
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
            return html;
        },

        _createWeek:function(){
            var html = '';
            var week = _weekArr.split(',');
            for (var i = 0; i < week.length; i++) {
                html += '<th>';
                html += week[i];
                html += '</th>';
            }
            return html;
        },
        // 获取当月天数
        _getMonthLen:function(year,month){
            month = parseInt(month, 10);
            var monthLen = new Date(year, month, 0);
            return monthLen.getDate();
        },
        // 获取今天日期
        _getToday:function(year,month,date){
            if(year == todayDate.getFullYear() && month == todayDate.getMonth()+1 && date == todayDate.getDate()){
                return true;
            }else {
                return false;
            }
        },
        // 获取月第一天
        _getFirstDay:function(year,month){
            month = parseInt(month, 10)-1;
            var firstDay = new Date(year,month,1);
            return firstDay.getDay();
        },
        _foo:function(str){
            str ='0'+str;
            return str.substring(str.length-2,str.length);
        }
    }
    window.auiHotelDatePicker = auiCalendar;
})(window);
