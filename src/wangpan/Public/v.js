window.CA=function(){var e="http://ca.kuaipan.cn/a.gif?",n=/j\/lib\/ca\/(ca|a)(\.js|$)/,t="ksc_suv",r=function(e,n){var t="",r=e.split("?");if(!r[1])return t;r=r[1].split("&");for(var i=0;i<r.length;i++){t=r[i].split("=");if(n==t[0]){return t[1]}}},i=function(e,n){return e+Math.floor(Math.random()*(n-e))},o=function(){return document.domain.replace(/^www\./,"")},a=function(e){if(e){var n=new RegExp("[; ]"+e+"=([^;]*)");var t=n.exec(document.cookie);if(t){return t[1]}}},u=function(e){var t=document.getElementsByTagName("script"),i;for(var o=0,a=t.length;o<a;o++){i=t[o].src;if(n.test(i)){return r(i,e)}}},f=function(){var e=window.CA_UID;if(!e&&window.CONST){e=CONST.uid||CONST.UID}return e||u("uid")||-1},c=function(){var e=a(t);if(e)return e;var n=new Date;e=i(1e7,2147483647)+"."+n.getTime();n.setTime(n.getTime()+100*365*24*60*60*1e3);document.cookie=t+"="+e+"; path=/; expires="+n+";domain="+o();return e},d=function(){h("","pv",{w:window.screen.width,h:window.screen.height})};var s={flag:window.CA_FLAG||u("flag"),uid:f(),suvid:c(),maxLen:4,isInit:false,arrImg:[],taskQueue:[]};var m=function(e){e=e||window.event;var n="data-ca",t=document.documentElement,r=document.body,i=e.srcElement?e.srcElement:e.target;while(i&&i!=r){var o=i.getAttribute(n);if(o){h(o,"click",{w:t.clientWidth,h:t.clientHeight,x:e.pageX,y:e.pageY});return}i=i.parentNode}};var g=function(){if(s.isInit)return;d();if(document.addEventListener){document.addEventListener("mousedown",m,false)}else if(document.attachEvent){document.attachEvent("onmousedown",m)}s.isInit=true};var l=function(e){s.flag=e};var v=function(e){s.uid=e};var w=function(e){if(!e)return;h(e,"logic")};var h=function(n,r,i,o){var a,u,f=[],c=o||e;if(i!=null){for(a in i){if(i.hasOwnProperty(a)){u=i[a];f.push('"'+a+'":'+(typeof u==="string"?'"'+u+'"':u))}}}c+=[t+"="+s.suvid,"flag="+s.flag,"uid="+encodeURIComponent(s.uid),"t="+(new Date).getTime(),"from="+encodeURIComponent(n),"e="+r,"page="+encodeURIComponent(location.href),"ref="+(document.referrer?encodeURIComponent(document.referrer):"")].join("&");if(f.length){c+="&d="+encodeURIComponent(f.join(","))}p(c)};var p=function(e){if(!e)return;var n,t=s.arrImg.length,r=-1;for(var i=0;i<t;i++){if(s.arrImg[i].f==0){r=i;break}}if(r==-1){if(t==s.maxLen){s.taskQueue.push(e);return}n=new Image;s.arrImg.push({f:1,img:n});r=t==0?0:t}else{n=s.arrImg[r].img}s.arrImg[r].f=1;n.setAttribute("vid",r);var o=function(){var e=this.getAttribute("vid");if(e>=0){s.arrImg[e].f=0}if(s.taskQueue.length>0){p(s.taskQueue.shift())}};n.onload=n.onerror=o;n.src=e};g();return{q:w,log:h,isInit:s.isInit,setFlag:l,setUID:v,flag:function(){return s.flag},pv:d}}();