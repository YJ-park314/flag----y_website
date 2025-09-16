<?php
if (!defined('_INDEX_')) define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

include_once(G5_THEME_PATH.'/head.php');
?>

<script src="https://www.youtube.com/iframe_api"></script>

<style>
    #hd, #ft{display: none !important;}
    *{margin: 0; padding: 0;}
    .dpnone{display: none !important;}
    ul{display: flex; flex-wrap: wrap; max-width: 1024px; list-style: none;}
    ul li{height: 200px; overflow: hidden; position: relative; display: flex; flex-direction: column; box-sizing: border-box; width: calc(25% - (((5px * 2) * 4) / 4)); margin: 5px; background: #000;}
    ul li img{position: absolute; top:0; left:0; width: 100%; height: 100%; object-fit: cover; object-position: center;}
    ul li p{position: absolute; z-index: 10; left: 0; bottom: 0; transform: translateY(100%); width: 100%; background: #fff; transition: .3s ease-out;}
    ul li p.active{transform: translateY(0);}
    ul li iframe{width: 100%; height: 100%; transform: scale(1.8)}

    /* iframe 부모 요소에 오버레이 추가 */
    .iframe-wrapper {
        position: relative;
        width: 100%;
        height: 100%;
        overflow: hidden;
    }

    .iframe-wrapper iframe {
        width: 100%;
        height: 100%;
        pointer-events: none; /* iframe 클릭 방지 */
    }

    .iframe-wrapper::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: transparent; /* 필요 시 투명도 조정 */
        pointer-events: none;
        z-index: 10;
    }
</style>

<article>
    <section>
        <ul class="ifr-list">
            <?php for($i=0; $i<6; $i++) { ?>
            <li title="https://www.youtube.com/embed/g4xs_5rZdos?si=lFYolZ6PeiepNex1" id="g4xs_5rZdos">
                <img src="/theme/basic/img/thumb1.jpg" alt="">
                <p>Number 123456</p>
                <!-- <iframe src="https://www.youtube.com/embed/g4xs_5rZdos?si=lFYolZ6PeiepNex1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe> -->
            </li>
            <li title="https://www.youtube.com/embed/9tqLpywgN-A?si=Sxc4u7Xufix856-2" id="9tqLpywgN-A">
                <img src="/theme/basic/img/thumb2.jpg" alt="">
                <p>Number 123456</p>
                <!-- <iframe src="https://www.youtube.com/embed/9tqLpywgN-A?si=Sxc4u7Xufix856-2" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                <p>Number 123456</p> -->
            </li>
            <li title="https://www.youtube.com/embed/JxIN5fruFFo?si=itU8A3P-zXQ0zQmK" id="JxIN5fruFFo">
                <img src="/theme/basic/img/thumb3.jpg" alt="">
                <p>Number 123456</p>
                <!-- <iframe src="https://www.youtube.com/embed/JxIN5fruFFo?si=itU8A3P-zXQ0zQmK" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                <p>Number 123456</p> -->
            </li>
            <li title="https://www.youtube.com/embed/PUnu_i5Jmtw?si=Zn0B_Z6EKLhQUaJr" id="PUnu_i5Jmtw">
                <img src="/theme/basic/img/thumb4.jpg" alt="">
                <p>Number 123456</p>
                <!-- <iframe src="https://www.youtube.com/embed/PUnu_i5Jmtw?si=Zn0B_Z6EKLhQUaJr" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                <p>Number 123456</p> -->
            </li>
            <?php } ?>
        </ul>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const listAll = document.querySelectorAll('.ifr-list li');

            let isYouTubeApiLoaded = false;

            function loadYouTubeAPI() {
                if (!isYouTubeApiLoaded) {
                    isYouTubeApiLoaded = true;
                    const tag = document.createElement('script');
                    tag.src = "https://www.youtube.com/iframe_api";
                    const firstScriptTag = document.getElementsByTagName('script')[0];
                    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
                }
            }

            window.onYouTubeIframeAPIReady = function() {
                console.log('YouTube API 로드 완료');
            };

            listAll.forEach((li, idx) => {
                li.addEventListener('mouseenter', e => {
                    const videoId = e.currentTarget.id;
                    const iframeContainerId = `playerPc${idx + 1}`;

                    // 중복 생성 방지
                    if (!li.querySelector(`#${iframeContainerId}`)) {
                        const iframeContainer = document.createElement('div');
                        iframeContainer.id = iframeContainerId;
                        iframeContainer.classList.add('iframe-wrapper');
                        li.appendChild(iframeContainer);

                        createPlayer(iframeContainerId, videoId);
                    }

                    li.querySelector('img').classList.add('dpnone');
                    li.querySelector('p').classList.add('active');
                });

                li.addEventListener('mouseleave', e => {
                    const iframe = li.querySelector('iframe');
                    if (iframe) iframe.remove();
                    li.querySelector('img').classList.remove('dpnone');
                    li.querySelector('p').classList.remove('active');
                });
            });

            loadYouTubeAPI();
        });

        function createPlayer(containerId, videoId) {
            return new YT.Player(containerId, {
                height: '100%',
                width: '100%',
                videoId: videoId,
                playerVars: {
                    autoplay: 1,
                    controls: 0,
                    modestbranding: 1,
                    rel: 0,
                    loop: 1,
                    playlist: videoId,
                    fs: 0,
                    cc_load_policy: 0,
                    iv_load_policy: 3,
                    disablekb: 1,
                    showinfo: 0,
                },
                events: {
                    onReady: event => {
                        event.target.mute();
                        event.target.playVideo();
                        // event.target.closest('li').querySelector('img').classList.add('dpnone');
                        // event.target.closest('li').querySelector('p').classList.add('active');   
                    }
                }
            });
        }
    </script>
</article>

<?php
include_once(G5_THEME_PATH.'/tail.php');