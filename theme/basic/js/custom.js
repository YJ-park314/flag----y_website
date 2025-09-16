window.addEventListener('DOMContentLoaded', () => {
    const url = new URL(window.location.href);
    const urlParams = url.searchParams;
    
    // 메인 딜리버리 서비스 이미지 슬라이드
    if(document.querySelector('.del-service .img-slide')) {
        const slideAll = document.querySelectorAll('.del-service .img-slide li');
        let hoverLock = false;

        slideAll.forEach(li => {
            li.addEventListener('mouseenter', e => {
                if (hoverLock) return;

                if(!li.classList.contains('active')) {
                    slideAll.forEach(li2 => {
                        li2.classList.remove('active');
                    });

                    li.classList.add('active');
    
                    hoverLock = true;
    
                    setTimeout(() => {
                        hoverLock = false;
                    }, 300);
                }
            });
        });
    }
    
    // 마이페이지 사이드메뉴 active
    if(document.querySelector('#mySide')) {
        const curUrl = window.location.href;
        const liAll = document.querySelectorAll('#mySide li');
    
        for(let i=0; i<Object.keys(mypage_url).length; i++) {
            if(curUrl.includes(mypage_url[Object.keys(mypage_url)[i]])) {
                liAll[i].classList.add('active');
                break;
            }
        }
    }

    // 서브페이지 common tab 공통 active
    if(document.querySelector('.common-tab')) {
        const tabAll = document.querySelectorAll('.common-tab a');

        tabAll.forEach(a => {
            if(window.location.href.includes('wr_id')) {
                if(a.href.includes(`${window.location.href.split('?')[0]}?bo_table=${urlParams.get('bo_table')}`)) {
                    a.closest('li').classList.add('active');
                }
            } else {
                if(a.href.includes(window.location.href)) {
                    a.closest('li').classList.add('active');
                }
            }
        });
    }
});

// 게시판 파일 첨부
if(document.querySelector('.file-con')) {
    const boWFileInput = document.querySelectorAll('input[name="bf_file[]"]');
    
    boWFileInput.forEach(inp => {
        inp.addEventListener('change', e => {
            const fileVal = e.target.value.split('\\');
            inp.parentElement.querySelector('.file-con').textContent = fileVal[fileVal.length - 1];
        });
    });
}

// 모바일
if(window.innerWidth <= 1024) {
    const hd = document.querySelector('#hd');
    const gnbBtnAll = hd.querySelectorAll('.gnb-btn');
    const moToggleAll = hd.querySelectorAll('.mo-toggle-menu');

    // header active
    if(document.querySelector('#mb_login') || document.querySelector('#sit') || document.querySelector('#ctt') || document.querySelector('#bo_v.basic')) { // 배경이 흰색인 페이지는 항상 active
        hd.classList.add('active');
    } else {
        window.addEventListener('scroll', () => {
            const scY = window.scrollY;
        
            if(scY > 30) {
                hd.classList.add('active');
            } else {
                hd.classList.remove('active');
            }
        });
    }

    // gnb close
    gnbBtnAll.forEach(btn => {
        btn.addEventListener('click', e => {
            e.preventDefault();

            if(e.currentTarget.classList.contains('open')) {
                hd.querySelector('#gnb').classList.add('active');
            } else {
                hd.querySelector('#gnb').classList.remove('active');
            }
    
        });
    });

    // gnb 서브메뉴 toggle
    moToggleAll.forEach(a => {
        $(a).closest('li').find('.submenu').slideUp(); // 모두 닫기

        a.addEventListener('click', e => {
            const thisLi = e.currentTarget.closest('li');
            const target = $(thisLi).find('.submenu');
            
            e.preventDefault();

            if(!target.is(':animated')) {
                $('#gnb .submenu').not(target).slideUp();
                $('#gnb .submenu').not(target).closest('li').removeClass('active');
                target.slideToggle();
                $(thisLi).toggleClass('active');
            }
        });
    });
}