/*
* @Author: Administrator
* @Date:   2018-12-20 10:00:41
* @Last Modified by:   liudifa
* @Last Modified time: 2019-07-30 10:11:03
*/

(function(){
	let wrap = document.querySelector('.wrap'),
		bannerUl    = wrap.querySelectorAll('ul')[0],
		banners     = bannerUl.querySelectorAll('li'),
		bannersLeng = banners.length,
		_width      = banners[0].offsetWidth;

		pointUl    = wrap.querySelectorAll('ul')[1],
		points     = pointUl.querySelectorAll('a'),
		pointsLeng = points.length,

		arrowUl    = wrap.querySelectorAll('ul')[2],
		arrows     = arrowUl.querySelectorAll('a'),
		arrowsLeng =arrows.length,

		index = 1, 
		timer = null;

    window.onload = window.onresize = () => {
      _width = banners[0].offsetWidth;
    }


		// 监听过渡是否完成
		bannerUl.addEventListener('transitionend', function(){
			if(index >= bannersLeng - 1){
				index = 1;

				// 删除过渡
				toggleTransition(bannerUl, false);
				// 位移
				animate(bannerUl, -index * _width + 'px');
			}else if(index <= 0){
				index = bannersLeng - 2;

				// 删除过渡
				toggleTransition(bannerUl, false);
				// 位移
				animate(bannerUl, -index * _width + 'px');
			}
		});

		timerStart();
		// 定时器的开关
		function timerStart(){
			timer = setInterval(change, 2000);
		}
		function timerStop(){
			clearInterval(timer);
		}

		// 箭头控制
		arrows.forEach(function(ele, index, self){
			ele.onclick = function(e){
				switch(e.target.className){
					case 'arrow_prev':
						prevPage();
					break;
					case 'arrow_next':
						nextPage();
					break;
				}
			}

			ele.onmouseover = function(){
				timerStop();
			}
			ele.onmouseout = function(){
				timerStart();
			}
		});

		// 上一张 || 下一张
		function prevPage(){
			index--;

			toggleTransition(bannerUl, true);

			animate(bannerUl, -index * _width + 'px');
		}
		function nextPage(){
			change();
		}
		function change(){

			index++;

			toggleTransition(bannerUl, true);

			animate(bannerUl, -index * _width + 'px');
		}

		// 焦点控制
		points.forEach(function(ele, index, self){
			ele.onclick = function(){
				console.log(index);

				this.className = 'active';

				animate(bannerUl, -index * _width + 'px');
			}

			ele.onmouseover = function(){
				timerStop();
			}
			ele.onmouseout = function(){
				timerStart();
			}
		});


		// 是否添加过渡
		function toggleTransition(target, isTransition){
			if(isTransition){
				target['style']['transition'] = 'all .3s ease-in-out';
				target['style']['webkitTransition'] = 'all .3s ease-in-out';
			}else{
				target['style']['transition'] = 'none';
				target['style']['webkitTransition'] = 'none';
			}
		}
		// 轮播图核心
		function animate(target, step){
			target['style']['transform'] = 'translateX(' + step + ')';
			target['style']['webkitTransform'] = 'translateX(' + step + ')';

			points.forEach(ele => ele.classList.remove('active'));
			points[index - 1].classList.add('active');
		}
}());