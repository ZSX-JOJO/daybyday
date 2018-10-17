(function () {
	$.fn.shijian = function (options) {
		function cPlugin(o) {
			var sjObj = o;
			sjObj.defaults = {
				type: "time",
				Format: "yyyy-mm-dd",
				Order: 'yymmdd',
				width: 60,
				height: 32,
				Year: true,
				Month: true,
				Day: true,
				Hour: true,
				Minute: true,
				Seconds: false,
				yyArr: [],
				mmArr: [],
				ddArr: [],
				hArr: [],
				mArr: [],
				sArr: [],
				yyyy: "0000",
				mm: "00",
				dd: "00",
				h: "00",
				m: "00",
				s: "00",
				val: null,
				yearText: "年",
				monthText: "月",
				dayText: '日',
				hourText: '时',
				minuteText: '分',
				secondsText: '秒',
				okText: "确认",
				cancelText: "取消",
				thisElm: null,
				showNowTime: true,
				alwaysShow: false,
				timeElm: null,
				onfun: function () {},
				okfun: function () {},
				t_box: null,
				df_persp: function () {
					return $("<div class='df-persp'><div class='persp-bg'></div>")
				},
				df_box: function () {
					return $("</div><div class='df-box " + (sjObj.opt.alwaysShow ? "alwaysShow" : "") + "' style='line-height:" + sjObj.opt.height + "px;'></div>")
				},
				df_main: function () {
					return $("<div class='df-main'>")
				},
				df_btn: function () {
					if (sjObj.opt.alwaysShow) {
						return
					}
					return $("<div class='df-btn' style='height:" + sjObj.opt.height + "px'><div class='df-ok'>" + sjObj.opt.okText + "</div><div class='df-no'>" + sjObj.opt.cancelText + "</div></div>")
				},
				df_wrap: function () {
					return $("<div class='df-wrap'><table><tbody><tr></tr></tbody></table></div>")
				},
				df_final: function () {
					return $("<div class='df-final'></div>")
				},
				getArr: function () {
					for (var i = 0; i < 60; i++) {
						if (i < 12 && !options.mmArr) this.mmArr[i] = (i + 1);
						if (i < 31 && !options.ddArr) this.ddArr[i] = (i + 1);
						if (i < 24 && !options.hArr) this.hArr[i] = i;
						if (i < 60 && !options.mArr) this.mArr[i] = i;
						this.sArr[i] = i;
					}
				},
				y: 1,
				nowTime: new Date(),
				startYear: null,
				endYear: null,
				ampmText: null,
				dataNum: 0,
				strStart: function (text, c) {
					var df = this;
					var str;
					var text = text || "";
					//console.log(this);
					if (df.width) {
						str = '<div class="df-class">' + text + '</div><div class="df-item " style="height:' + (df.height * 5 - 1) + 'px;min-width:' + df.width + 'px"><ul class="df-ul" data-class=' + c + '>';
					} else {
						str = '<div class="df-class">' + text + '</div><div class="df-item " style="height:' + (df.height * 5 - 1) + 'px"><ul class="df-ul" data-class=' + c + '>';
					}
					sjObj.opt.dataNum++;
					return str;
				},
				strEnd: function () {
					var df = this;
					return "</ul><div class='G-bg'><div class='G-top' style='height:" + (df.height * 2) + "px'></div><div class='G-mid' style='height:" + df.height + "px'></div><div class='G-btm' style='height:" + (df.height * 2) + "px'></div></div></div>"
				},
				fillZero: function (x) {
					if (x < 10) {
						return x = "0" + x;
					} else {
						return "" + x;
					}
				},
				getYear: function () {
					if (!this.startYear && !options.yyArr) {
						var y = sjObj.opt.y || 10;
						nowTime = new Date();
						//console.log()
						for (var x = this.y, i = 0; x != 0; sjObj.opt.y > 0 ? x-- : x++, i++) {
							if (sjObj.opt.y < 0) {
								sjObj.opt.yyArr[i] = nowTime.getFullYear() + x + 1;
							} else {
								sjObj.opt.yyArr[i] = nowTime.getFullYear() + i;
							}
						}
						sjObj.opt.getArr()
					}
				},
				setCenter: function () {
					var wid = $(window).width();
					var tabWid = null;
					var mWid = 0;
					$(".df-wrap table").each(function () {
						tabWid += parseFloat($(this).width());
					})
					if (tabWid > wid) {
						$(".df-wrap table").each(function () {
							mWid = parseFloat($(this).width()) > mWid ? parseFloat($(this).width()) : mWid;
						})
						$('.df-box').width(mWid);
					} else {
						$('.df-box').width(tabWid + 10)
					}
				},
				buildArrStr: function (Arr, txt, c) {
					var str = this.strStart(txt, c);
					$.each(Arr, function () {
						str += '<li class="df-li df-show"  data-val=' + sjObj.opt.fillZero(this) + ' style="line-height:' + sjObj.opt.height + 'px;height:' + sjObj.opt.height + 'px">' + sjObj.opt.fillZero(this) + '</li>'
					})
					//console.log(Arr)
					str += sjObj.opt.strEnd();
					return str;
				},
				buildHTml: function () {
					var wrap = sjObj.opt.df_wrap();
					sjObj.opt.t_box = sjObj.opt.df_box();
					var main = sjObj.opt.df_main();
					var persp = sjObj.opt.df_persp();
					//console.log(sjObj.opt.t_box);
					if (sjObj.opt.alwaysShow) {
						sjObj.opt.timeElm = eval(sjObj.opt.timeElm);
						//console.log(sjObj.opt.timeElm)
						sjObj.opt.timeElm.append(sjObj.opt.t_box.append(main.append(wrap)));
					} else {
						sjObj.opt.timeElm = $("<div class='df-persp'><div class='persp-bg'></div>");
						sjObj.opt.timeElm.append(sjObj.opt.t_box.append(sjObj.opt.df_final).append(main.append(wrap)).append(sjObj.opt.df_btn));
						$('body').append(sjObj.opt.timeElm)
					}
					if (sjObj.opt.ampmText) {
						main.append("<div class='df-wrap'><table><tbody><tr><td>" + sjObj.opt.buildAmPmStr() + "</tr></tbody></table></div>")
					}
					if (sjObj.opt.Format == "dd-mm-yyyy") {
						if (sjObj.opt.Day) $(sjObj.opt.timeElm.find('.df-wrap')[0]).find('tr').append("<td>" + sjObj.opt.buildArrStr(sjObj.opt.ddArr, sjObj.opt.dayText, "dd") + "</td>");
						if (sjObj.opt.Month) $(sjObj.opt.timeElm.find('.df-wrap')[0]).find('tr').append("<td>" + sjObj.opt.buildArrStr(sjObj.opt.mmArr, sjObj.opt.monthText, "mm") + "</td>");
						if (sjObj.opt.Year) $(sjObj.opt.timeElm.find('df-wrap')[0]).find('tr').append("<td>" + sjObj.opt.buildArrStr(sjObj.opt.yyArr, sjObj.opt.yearText, "yyyy") + "</td>");
					} else if (sjObj.opt.Format == "mm-dd-yyyy") {
						if (sjObj.opt.Month) $(sjObj.opt.timeElm.find('.df-wrap')[0]).find('tr').append("<td>" + sjObj.opt.buildArrStr(sjObj.opt.mmArr, sjObj.opt.monthText, "mm") + "</td>");
						if (sjObj.opt.Day) $(sjObj.opt.timeElm.find('.df-wrap')[0]).find('tr').append("<td>" + sjObj.opt.buildArrStr(sjObj.opt.ddArr, sjObj.opt.dayText, "dd") + "</td>");
						if (sjObj.opt.Year) $(sjObj.opt.timeElm.find('.df-wrap')[0]).find('tr').append("<td>" + sjObj.opt.buildArrStr(sjObj.opt.yyArr, sjObj.opt.yearText, "yyyy") + "</td>");
					} else {
						if (sjObj.opt.Year) $(sjObj.opt.timeElm.find('.df-wrap')[0]).find('tr').append("<td>" + sjObj.opt.buildArrStr(sjObj.opt.yyArr, sjObj.opt.yearText, "yyyy") + "</td>");
						if (sjObj.opt.Month) $(sjObj.opt.timeElm.find('.df-wrap')[0]).find('tr').append("<td>" + sjObj.opt.buildArrStr(sjObj.opt.mmArr, sjObj.opt.monthText, "mm") + "</td>");
						if (sjObj.opt.Day) $(sjObj.opt.timeElm.find('.df-wrap')[0]).find('tr').append("<td>" + sjObj.opt.buildArrStr(sjObj.opt.ddArr, sjObj.opt.dayText, "dd") + "</td>");
					}
					if (sjObj.opt.Hour) {
						var eml = sjObj.opt.df_wrap();
						$(eml).find('tr').append("<td>" + sjObj.opt.buildArrStr(sjObj.opt.hArr, sjObj.opt.hourText, "h") + "</td>")
						if (sjObj.opt.Minute) {
							$(eml).find('tr').append("<td>" + sjObj.opt.buildArrStr(sjObj.opt.mArr, sjObj.opt.minuteText, "m") + "</td>")
						};
						if (sjObj.opt.Seconds) {
							$(eml).find('tr').append("<td>" + sjObj.opt.buildArrStr(sjObj.opt.sArr, sjObj.opt.secondsText, "m") + "</td>")
						}
						main.append(eml)
					};
					if (sjObj.opt.showNowTime) {
						if (sjObj.value) {
							//console.log("input中有值")
							var str = sjObj.value
							if (str.length < 16) {
								//console.log("长度小于16 补充年月日空白")
								str = "2000/01/01 " + str;
							}
							//console.log("字符串转时间")
							var data = new Date(str.replace(/-/g, "/"));
						} else {
							var data = new Date();
						}
						//console.log(data);
						var year = data.getFullYear();
						var month = data.getMonth() + 1;
						var day = data.getDate();
						var hours = data.getHours();
						var Minutes = data.getMinutes();
						//console.log(year, month, day, hours, Minutes);
						//console.log("是否显示年", sjObj.opt.Year)
						if (sjObj.opt.Year) sjObj.opt.timeElm.find("[data-class='yyyy'] .df-li").each(function () {
							//console.log(parseInt($(this).attr("data-val")), parseInt(year))
							if (parseInt($(this).attr("data-val")) == parseInt(year)) {
								var pY = -($(this).index() - 2) * sjObj.opt.height;
								//console.log(pY, year)
								$(this).parent().css({
									"transform": "translate(0," + pY + "px)"
								})
							}
						})
						if (sjObj.opt.Month) sjObj.opt.timeElm.find("[data-class='mm'] .df-li").each(function () {
							if (parseInt($(this).attr("data-val")) == parseInt(month)) {
								var pY = -($(this).index() - 2) * sjObj.opt.height;
								//console.log(pY, month)
								$(this).parent().css({
									"transform": "translate(0," + pY + "px)"
								})
							}
						})
						if (sjObj.opt.Day) sjObj.opt.timeElm.find("[data-class='dd'] .df-li").each(function () {
							if (parseInt($(this).attr("data-val")) == parseInt(day)) {
								var pY = -($(this).index() - 2) * sjObj.opt.height;
								//console.log(day)
								$(this).parent().css({
									"transform": "translate(0," + pY + "px)"
								})
							}
						})
						if (sjObj.opt.Hour) sjObj.opt.timeElm.find("[data-class='h'] .df-li").each(function () {
							if (parseInt($(this).attr("data-val")) == parseInt(hours)) {
								var pY = -($(this).index() - 2) * sjObj.opt.height;
								$(this).parent().css({
									"transform": "translate(0," + pY + "px)"
								})
							}
						})
						if (sjObj.opt.Minute) sjObj.opt.timeElm.find("[data-class='m'] .df-li").each(function () {
							if (parseInt($(this).attr("data-val")) == parseInt(Minutes)) {
								var pY = -($(this).index() - 2) * sjObj.opt.height;
								//console.log(pY, Minutes, $(this).index(), this)
								$(this).parent().css({
									"transform": "translate(0," + pY + "px)"
								})
							}
						})
						if (sjObj.opt.Seconds) sjObj.opt.timeElm.find("[data-class='m'] .df-li").each(function () {
							if (parseInt($(this).attr("data-val")) == parseInt(Seconds)) {
								var pY = -($(this).index() - 2) * sjObj.opt.height;
								$(this).parent().css({
									"transform": "translate(0," + pY + "px)"
								})
							}
						})
					} else {
						//console.log("使用自定义时间")
						if (sjObj.opt.Year) sjObj.opt.timeElm.find("[data-class='yyyy'] .df-li").each(function () {
							if (parseInt($(this).attr("data-val")) == parseInt(sjObj.opt.yyyy)) {
								var pY = -($(this).index() - 2) * sjObj.opt.height;
								$(this).parent().css({
									"transform": "translate(0," + pY + "px)"
								})
							}
						})
						if (sjObj.opt.Month) sjObj.opt.timeElm.find("[data-class='mm'] .df-li").each(function () {
							if (parseInt($(this).attr("data-val")) == parseInt(sjObj.opt.mm)) {
								var pY = -($(this).index() - 2) * sjObj.opt.height;
								$(this).parent().css({
									"transform": "translate(0," + pY + "px)"
								})
							}
						})
						if (sjObj.opt.Day) sjObj.opt.timeElm.find("[data-class='dd'] .df-li").each(function () {
							if (parseInt($(this).attr("data-val")) == parseInt(sjObj.opt.dd)) {
								var pY = -($(this).index() - 2) * sjObj.opt.height;
								$(this).parent().css({
									"transform": "translate(0," + pY + "px)"
								})
							}
						})
						if (sjObj.opt.Hour) sjObj.opt.timeElm.find("[data-class='h'] .df-li").each(function () {
							if (parseInt($(this).attr("data-val")) == parseInt(sjObj.opt.h)) {
								var pY = -($(this).index() - 2) * sjObj.opt.height;
								//console.log(pY, sjObj.opt.h, $(this).index())
								$(this).parent().css({
									"transform": "translate(0," + pY + "px)"
								})
							}
						})
						if (sjObj.opt.Minute) sjObj.opt.timeElm.find("[data-class='m'] .df-li").each(function () {
							if (parseInt($(this).attr("data-val")) == parseInt(sjObj.opt.m)) {
								var pY = -($(this).index() - 2) * sjObj.opt.height;
								//console.log(pY, sjObj.opt.m, $(this).index())
								$(this).parent().css({
									"transform": "translate(0," + pY + "px)"
								})
							}
						})
						if (sjObj.opt.Seconds) sjObj.opt.timeElm.find("[data-class='m'] .df-li").each(function () {
							if (parseInt($(this).attr("data-val")) == parseInt(sjObj.opt.s)) {
								var pY = -($(this).index() - 2) * sjObj.opt.height;
								$(this).parent().css({
									"transform": "translate(0," + pY + "px)"
								})
							}
						})
						//console.log("设置默认时间")
					}
					sjObj.opt.fillData();
					sjObj.opt.setCenter();
					sjObj.opt.bindFun();
				},
				bindFun: function () {
					sjObj.opt.timeElm.find(".df-no").on("click", function () {
						$(this).parent().parent().parent().remove();
						$("html").removeClass("ov_hi");
					})
					sjObj.opt.timeElm.find(".df-ok").on("click", function () {
						var str = "";
						if (sjObj.opt.Year) {
							str = sjObj.opt.Format.replace("yyyy", sjObj.opt.yyyy)
						}
						if (sjObj.opt.Month) {
							str = str.replace("mm", sjObj.opt.mm);
						}
						if (sjObj.opt.Day) {
							str = str.replace("dd", sjObj.opt.dd) + " ";
						}
						str += sjObj.opt.h + ":" + sjObj.opt.m;
						sjObj.opt.val = str;
						//console.log("我执行了没")
						$(sjObj.opt.thisElm).val(sjObj.opt.val);
						$(this).parent().parent().parent().remove();
						sjObj.opt.okfun();
						$("html").removeClass("ov_hi");
					})
					sjObj.opt.moveElm(sjObj.opt.timeElm.find(".G-bg"))
				},
				fillData: function () {
					var str = "";
					if (sjObj.opt.Year) {
						str += sjObj.opt.yyyy + '-';
					}
					if (sjObj.opt.Month) {
						str += sjObj.opt.mm + '-'
					}
					if (sjObj.opt.Day) {
						str += sjObj.opt.dd + " "
					}
					str += sjObj.opt.h + ":";
					str += sjObj.opt.m;
					if (!sjObj.opt.alwaysShow) {
						//console.log("直接显示？", sjObj.opt.timeElm.find(".df-final"))
						sjObj.opt.timeElm.find(".df-final").html(str);
					} else {
						//console.log("啊哈哈哈哈啊？", sjObj.opt.timeElm.find(".df-final"))
						$(sjObj.opt.thisElm).html(str).val(str);
					}
				},
				vardata: function (name, val) {
					if (!val) {
						return;
					}
					if (sjObj.opt[name] != val) {
						sjObj.opt[name] = val;
						sjObj.opt.fillData();
					}
				},
				getFinal: function () {
					var currentY = 0;
					var str = "";
					if (sjObj.opt.showNowTime) {
						sjObj.opt.timeElm.find(".df-ul").each(function () {
							currentY = getTranslateY(this);
							var dataClass = $(this).attr("data-class");
							var val = $($(this).find(".df-li")[Math.round(currentY / sjObj.opt.height) + 2]).attr("data-val");
							sjObj.opt.vardata(dataClass, val);
							//console.log(dataClass, val)
							$(this).unbind("webkitTransitionEnd").on("webkitTransitionEnd", function () {
								currentY = getTranslateY(this);
								var val = $($(this).find(".df-li")[Math.round(currentY / sjObj.opt.height) + 2]).attr("data-val");
								dataClass = $(this).attr("data-class");
								sjObj.opt.vardata(dataClass, val);
								sjObj.opt.daysJudge(dataClass);
							})
						})
					} else {
						sjObj.opt.timeElm.find(".df-ul").each(function () {
							currentY = getTranslateY(this);
							var dataClass = $(this).attr("data-class");
							var val = $($(this).find(".df-li")[Math.round(currentY / sjObj.opt.height) + 2]).attr("data-val");
							sjObj.opt.vardata(dataClass, val);
							//console.log(dataClass, val)
							$(this).unbind("webkitTransitionEnd").on("webkitTransitionEnd", function () {
								currentY = getTranslateY(this);
								var val = $($(this).find(".df-li")[Math.round(currentY / sjObj.opt.height) + 2]).attr("data-val");
								dataClass = $(this).attr("data-class");
								sjObj.opt.vardata(dataClass, val);
								sjObj.opt.daysJudge(dataClass);
							})
						})
					}
				},
				daysJudge: function (name) {
					if (name == 'mm' || name == "yyyy") {
						var day = new Date(sjObj.opt.yyyy, sjObj.opt.mm, 0).getDate();
						var l = sjObj.opt.timeElm.find('[data-class="dd"]').find(".df-show").length
						var mubiao = day - l;
						if (mubiao > 0) {
							for (var i = 0; i < mubiao; i++) {
								$(sjObj.opt.timeElm.find('[data-class="dd"]').find(".df-li")[l + i]).removeClass("df-hide").addClass("df-show")
							}
						} else {
							var naomovey = getTranslateY(sjObj.opt.timeElm.find('[data-class="dd"]'))
							for (var i = 0; i > mubiao; i--) {
								$(sjObj.opt.timeElm.find('[data-class="dd"]').find(".df-li")[l - 1 + i]).removeClass("df-show").addClass("df-hide")
							}
							if (naomovey > (day - 1 - 2) * sjObj.opt.height) {
								sjObj.opt.timeElm.find('[data-class="dd"]').css({
									"transition": "all .5s"
								})
								sjObj.opt.timeElm.find('[data-class="dd"]').css({
									"transform": "translate(0," + -(day - 1 - 2) * sjObj.opt.height + "px)"
								})
							}
						}
					};
				},
				moveElm: function (eml) {
					return $(eml).each(function () {
						var sX = null,
							sY = null,
							mX = null,
							mY = null,
							eX = null,
							eY = null,
							sTime = null,
							eTime = null,
							mTime = null,
							nTime = null,
							nY = 0,
							drt = null,
							nowElm = null,
							canStart = true,
							canMove = false,
							canEnd = false,
							emlLang = null,
							maxY = null,
							minY = null,
							lastY = null,
							nowY = null,
							moveY = null,
							stopInertiaMove = false,
							SE = null,
							ME = null,
							EE = null,
							moveCy = 0;
						var stop = function (e) {
							if (e.preventDefault)
								e.preventDefault();
							e.returnValue = false;
						}
						var moveStart = function (e) {
							//console.log(e);
							stop(e);
							if (!canStart) {
								return
							}
							if (e.originalEvent.touches) {
								SE = e.originalEvent.targetTouches[0]
							} else {
								SE = e;
							}
							sX = SE.pageX;
							sY = SE.pageY;
							nowElm = $(this).prev(".df-ul");
							emlLang = nowElm.find(".df-show").length;
							lastY = sY;
							nY = getTranslateY(nowElm);
							//console.log("移动开始时", e);
							sTime = new Date().getTime();
							if (!canMove && canEnd) {
								return false
							}
							canStart = false
							canMove = false;
							stopInertiaMove = true;
							$(window).on("touchmove", function (e) {
								if (stopInertiaMove) {
									e.preventDefault();
								}
							})
						};
						var moveing = function (e) {
							stop(e);
							if (e.originalEvent.touches) {
								ME = e.originalEvent.targetTouches[0]
							} else {
								ME = e;
							}
							mTime = new Date().getTime();
							mX = ME.pageX;
							mY = ME.pageY;
							drt = GetSlideDirection(sX, sY, mX, mY);
							if ((drt == 1 || drt == 2) && !canStart) {
								canMove = true;
								canEnd = true;
								stopInertiaMove = true;
							}
							if (canMove) {
								nowElm.css({
									"transition": "none"
								})
								nowElm.css({
									"transform": "translate(0," + -(nY - (mY - sY)) + "px)"
								})
								sjObj.opt.getFinal();
							}
							if (mTime - sTime > 300) {
								//console.log("移动后加速")
								sTime = mTime;
								lastY = mY;
							}
						};
						var moveEnd = function (e) {
							stop(e);
							if (e.originalEvent.touches) {
								EE = e.originalEvent.changedTouches[0]
							} else {
								EE = e;
							}
							eX = EE.pageX;
							eY = EE.pageY;
							maxY = sjObj.opt.height * 2;
							minY = -(emlLang - 3) * sjObj.opt.height;
							if (canEnd) {
								canMove = false;
								canEnd = false;
								canStart = true;
								nY = -(nY - (mY - sY));
								nowY = eY;
								if (nY > maxY) {
									nowElm.css({
										"transition": "all .5s"
									})
									nowElm.css({
										"transform": "translate(0," + maxY + "px)"
									})
								} else if (nY < minY) {
									nowElm.css({
										"transition": "all .5s"
									})
									nowElm.css({
										"transform": "translate(0," + minY + "px)"
									})
								} else {
									eTime = new Date().getTime();
									var speed = ((nowY - lastY) / (eTime - sTime));
									stopInertiaMove = false;
									(function (v, startTime, contentY) {
										var dir = v > 0 ? -1 : 1;
										var deceleration = dir * 0.001;

										function inertiaMove() {
											if (stopInertiaMove)
												return;
											var nowTime = new Date().getTime();
											var t = nowTime - startTime;
											var nowV = v + t * deceleration;
											var moveY = (v + nowV) / 2 * t;
											if (dir * nowV > 0) {
												if (moveCy > sjObj.opt.maxY) {
													nowElm.css({
														"transition": "all .5s"
													})
													sjObj.opt.nowElm.css({
														"transform": "translate(0," + sjObj.opt.maxY + "px)"
													})
												} else if (moveCy < sjObj.opt.minY) {
													nowElm.css({
														"transition": "all .5s"
													})
													nowElm.css({
														"transform": "translate(0," + sjObj.opt.minY + "px)"
													})
												} else {
													var MC = Math.round(moveCy / sjObj.opt.height)
													if (MC > 2) {
														MC = 2
													} else if (MC < -(emlLang - 1) + 2) {
														MC = -(emlLang - 1) + 2
													}
													nowElm.css({
														"transition": "all .4s"
													});
													nowElm.css({
														"transform": "translate(0," + sjObj.opt.height * MC + "px)"
													})
												}
												sjObj.opt.getFinal();
												return
											}
											moveCy = (contentY + moveY)
											if (moveCy > (maxY + (sjObj.opt.height * 2))) {
												nowElm.css({
													"transition": "all .5s"
												})
												nowElm.css({
													"transform": "translate(0," + maxY + "px)"
												})
												return
											} else if (moveCy < (minY - (sjObj.opt.height * 2))) {
												nowElm.css({
													"transition": "all .5s"
												})
												nowElm.css({
													"transform": "translate(0," + minY + "px)"
												})
												return
											}
											nowElm.css({
												"transform": "translate(0," + moveCy + "px)"
											})
											sjObj.opt.getFinal();
											var timers = setTimeout(inertiaMove, 10);
										}
										inertiaMove();
									})(speed, eTime, nY);
								}
								//console.log("移动结束", EE)
							}
						}
						//console.log("开始绑定事件", $(this))
						$(this).unbind("touchstart mousedown").on("touchstart mousedown", moveStart)
						$(this).unbind("touchmove").on("touchmove", moveing)
						$(this).unbind("touchend").on("touchend", moveEnd)
						$(document).on("mousemove", moveing)
						$(document).on("mouseup", moveEnd)
					})
				},
			}
			sjObj.opt = $.extend({}, sjObj.defaults, options);
			var GetSlideAngle = function (dx, dy) {
				return Math.atan2(dy, dx) * 180 / Math.PI;
			}
			var GetSlideDirection = function (startX, startY, endX, endY) {
				var dy = startY - endY;
				var dx = endX - startX;
				var result = 0;
				if (Math.abs(dx) < 2 && Math.abs(dy) < 2) {
					return result;
				}
				var angle = GetSlideAngle(dx, dy);
				if (angle >= -45 && angle < 45) {
					result = 4;
				} else if (angle >= 45 && angle < 135) {
					result = 1;
				} else if (angle >= -135 && angle < -45) {
					result = 2;
				} else if ((angle >= 135 && angle <= 180) || (angle >= -180 && angle < -135)) {
					result = 3;
				}
				return result;
			};
			var getTranslateY = function (eml) {
				var matrix = $(eml).css("transform");
				//console.log("获取到的transform", matrix)
				var T;
				if (matrix == "none") {
					T = 0;
				} else {
					var arr = matrix.split(",")
					T = -(arr[5].split(")")[0]);
				}
				//console.log("返回的transform", T)
				return T
			}
			sjObj.innt = function () {
				if (!sjObj.opt.alwaysShow) {
					$(this).on("click", function () {
						sjObj.opt.thisElm = this;
						switch (sjObj.opt.type) {
							case "time":
								$("html").addClass("ov_hi");
								$(this).blur();
								sjObj.opt.getYear();
								sjObj.opt.buildHTml();
								sjObj.opt.getFinal();
								break;
						}
					})
				} else {
					sjObj.opt.thisElm = this;
					//console.log("直接显示")
					sjObj.opt.getYear();
					sjObj.opt.buildHTml();
				}
				$(window).on("resize", function () {
					//console.log("窗口大小改变")
					sjObj.opt.setCenter()
				})
			}
			sjObj.innt();
			return sjObj
		}
		if (this.length > 1) {
			//console.log("多个")
			var arr = []
			$.each(this, function () {
				arr.push(cPlugin(this))
			})
			return arr
		} else {
			//console.log("一个")
			obj = cPlugin(this);
			//console.log("一个时间对象", obj);
			return obj
		}
	}
})(jQuery)
