<?php
namespace PressDo
{
    class WikiSkin
    {
        public static function AboveContent(){
            global $conf, $uri;
            ?><!DOCTYPE html>
              <head>
                <link rel="stylesheet" href="/skin/liberty/skin.css">
                <link href="<?=$conf['FaviconURL']?>" rel="SHORTCUT ICON">
                <meta charset="UTF-8">
                <meta name="author" content="PRASEOD-">
                <meta name="title" content="<?=$conf['SiteName']?>">
                <meta name="description" content="<?=$conf['Description']?>">
                <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0 ,user-scalable=no">
                <meta http-equiv="Content-Type" content="text/html;">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta property="og:type" content="website">
                <meta property="og:title" content=<?=$conf['SiteName']?>>
                <meta property="og:description" content="<?=$conf['Description']?>">
                <title> <?=$_GET['title']?> - <?=$conf['SiteName']?> </title>
            <script>
                function hiddencontents(a){
                    b = document.getElementById(a);
                    c = document.getElementById('content-'+a);
                    if(b.getAttribute('pressdo-toc-fold') == 'hide'){
                        b.setAttribute('pressdo-toc-fold', 'show');
                        c.setAttribute('pressdo-toc-fold', 'show');
                    }else{
                    b.setAttribute('pressdo-toc-fold', 'hide');
                        c.setAttribute('pressdo-toc-fold', 'hide');
                    }
                }
            </script>
            </head>
            <body>
                    <div pressdo-cover>
                        <div nav-cover>
                            <nav>
                                <a href="/" pressdo-logo><?=$conf['TitleText']?></a>
                                <ul nav-container>
                                    <li pressdo-navitem-nonlist>
                                        <a href="<?=$uri['RecentChanges']?>" pressdo-navitem-nonlist title="최근 변경">
                                            <span ionicon ion-compass></span>
                                            <span nav-text>최근 변경</span>
                                        </a>
                                    </li>
                                    <li pressdo-navitem-listdown>
                                        <a href="<?=$uri['RecentDiscuss']?>" pressdo-navitem-nonlist title="최근 토론">
                                            <span ionicon ion-discuss></span>
                                            <span nav-text>최근 토론</span>
                                        </a>
                                    </li>
                                    <li pressdo-navitem-nonlist>
                                        <a href="<?=$uri['random']?>" pressdo-navitem-nonlist title="무작위">
                                            <span ionicon ion-rand></span>
                                            <span nav-text>무작위</span>
                                        </a>
                                    </li>
                                    <li pressdo-navitem-listdown>
                                        <a id="nav-menu" pressdo-toc-fold=hide pressdo-navitem-listdown title="특수 기능">
                                            <span ionicon ion-func></span>
                                            <span nav-text>특수 기능</span>
                                            <span ionicon ion-dropdown></span>
                                        </a>
                                        <div pressdo-navfunc pressdo-toc-fold=hide id="content-nav-menu" role="menu">
                                            <a href="//board.namu.wiki/" title="게시판" data-v-193fc2b2="" data-v-b986d46e="" data-v-3e5e2b49="">
                                                <span class="i ion-ios-clipboard" data-v-193fc2b2=""></span> 
                                                <span class="t" data-v-193fc2b2="">게시판</span>
                                            </a> 
                                            <div pressdo-crossline></div> 
                                            <a href="<?=$uri['NeededPages']?>" title="작성이 필요한 문서" data-v-193fc2b2="" data-v-b986d46e="" data-v-3e5e2b49="">
                                                <span class="i ion-md-alert" data-v-193fc2b2=""></span> 
                                                <span class="t" data-v-193fc2b2="">작성이 필요한 문서</span>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                                <div pressdo-usermenu>
                            <?php if(isset($_SESSION['userid'])){ ?>
                                <a href="#" title="Profile" pressdo-usermenu>
                                    <img pressdo-usermenu src=<?=$_SESSION['pfpic']?> alt=<?=$_SESSION['userid']?>>
                                </a><?php
                            }else{ ?>
                                <a href="<?=$uri['login']?>" title="Login" pressdo-usermenu>
                                    <span ionicon ion-unlogined pressdo-usermenu-unlogined></span>
                                </a><?php
                            } ?>

                                </div>
                                <form pressdo-search-form>
                                    <div pressdo-search-form>
                                        <input type="search" name="keyword" placeholder="Search" tabindex="1" pressdo-search autocomplete="off">
                                        <span pressdo-sb>
                                            <button type="button" onclick="search();" pressdo-sb>
                                                <span ionicon ion-search></span>
                                            </button>
                                            <button type="button" onclick="godirectly();" pressdo-sb>
                                                <span ionicon ion-move></span>
                                            </button>
                                        </span>
                                    </div>
                                </form>
                            </nav>
                        </div>
                        <section>
                        <aside>
                            <div>
                                편집 내역
                            </div>
                        </aside>
                        <div pressdo-content> <?php
        }

        public static function BelowContent(){
            global $conf; ?>
            </section>
                    <footer>
                        <ul class="pressdo-footer-icons">
                            <li class="pressdo-footer-poweredby">
                                <a href="//gitlab.com/librewiki/Liberty-MW-Skin">Liberty</a> | 
                                <a href="//github.com/aaei924/PressDoWiki/">PressDo</a>
                            </li>
                        </ul>
                        <hr>
                        <?=stripslashes($conf['PageFooter'])?>
                        <br>
                        <br>
                        <br>
                        <br>
                    </footer>
                    </div></body><?php
        }

        public static function wiki($Doc, $NS, $Title, $content, $savetime, $rev=null){
            global $conf, $uri;
            WikiSkin::AboveContent();
            if(!$content){?>
                <div pressdo-content-header>
                    <div pressdo-toolbar>
                        <div pressdo-toolbar-menu>
                            <a pressdo-toolbar-link href="<?=$uri['backlink'].$Doc?>">역링크</a>
                            <a pressdo-toolbar-link href="<?=$uri['discuss'].$Doc?>">토론</a>
                            <a pressdo-toolbar-link href="<?=$uri['edit'].$Doc?>">편집</a>
                            <a pressdo-toolbar-link href="<?=$uri['history'].$Doc?>">역사</a>
                            <a pressdo-toolbar-link pressdo-toolbar-last href="<?=$uri['acl'].$Doc?>">ACL</a>
                        </div>
                    </div>
                    <h1 pressdo-doc-title><a href="<?=$uri['wiki'].$Doc?>"><span pressdo-title-namespace><?=$NS?></span><?=$Title?></a></h1>
                </div>
                <div id="cont_ent" pressdo-doc-content>
                    <span> 해당 문서를 찾을 수 없습니다. </span><br>
                    <p><a href="<?=$uri['edit'].$Doc?>">[새 문서 만들기]</a></p>
                </div>
                <footer pressdo-con-footer>
                    <p><?=stripslashes($conf['CopyRightText'])?></p>
                </footer>
            
            <?php }else{ ?>
                    <div pressdo-content-header>
                        <div pressdo-toolbar>
                            <div pressdo-toolbar-menu>
                                <a pressdo-toolbar-link href="<?=$uri['backlink'].$Doc?>">역링크</a>
                                <a pressdo-toolbar-link href="<?=$uri['discuss'].$Doc?>">토론</a>
                                <a pressdo-toolbar-link href="<?=$uri['edit'].$Doc?>">편집</a>
                                <a pressdo-toolbar-link href="<?=$uri['history'].$Doc?>">역사</a>
                                <a pressdo-toolbar-link pressdo-toolbar-last href="<?=$uri['acl'].$Doc?>">ACL</a>
                            </div>
                        </div>
                        <h1 pressdo-doc-title><a href="<?=$uri['wiki'].rawurlencode($Doc)?>"><span pressdo-title-namespace><?=$NS?></span><?=$Title?></a>
                            <?php if($rev !== null){ ?><small pressdo-doc-action>(r<?=$rev?> 판)</small><?php } ?>
                        </h1>
                    </div>
                    <div id="cont_ent" pressdo-doc-content>
                        <div id="categoryspace_top"></div>
                        <?=$content?>
                        <script>
                            // 분류 위치 조정
                            var f = document.getElementById('categories');
                            var parent = f.parentNode.parentNode;
                            parent.insertBefore(f, parent.childNodes[0]);
                        </script>
                    </div>
                    <footer pressdo-con-footer>
                        <ul>
                            <li pressdo-doc-changed>이 문서는 <?=date("Y-m-d H:i:s", $savetime)?> 에 마지막으로 바뀌었습니다.</li>
                            <li pressdo-doc-copyright> <?=stripslashes($conf['CopyRightText'])?></li>
                        </ul>
                    </footer>
            <?php WikiSkin::BelowContent();
            }
        }
        public static function edit($Doc, $raw, $ver=false, $preview=false){
            global $conf;
            WikiSkin::AboveContent();?>
                <div pressdo-content-header>
                    <div pressdo-toolbar>
                        <div pressdo-toolbar-menu>
                            <a pressdo-toolbar-link href="<?=$uri['backlink'].$Doc?>">역링크</a>
                            <a pressdo-toolbar-link pressdo-toolbar-d rel="nofollow" href="<?=$uri['delete'].$Doc?>">삭제</a>
                            <a pressdo-toolbar-link pressdo-toolbar-last rel="nofollow" href="<?=$uri['move'].$Doc?>">이동</a>
                        </div>
                    </div>
                    <h1 pressdo-doc-title><a href="<?=$uri['wiki'].$Doc?>"><span pressdo-title-namespace><?=$NS?></span><?=$Title?></a> 
                        <small pressdo-doc-action><?php echo (!$ver)? '(새 문서 생성)':"(r".$ver ." 편집)"; ?></small>
                    </h1>
                </div>
                <?php echo (!$raw)? "<p> 새 문서를 생성합니다. </p>": "<p> 문서를 편집하는 중입니다. </p>";
?>                  <pressdo-anchor id="_pressdo-form-anchor">
                <form method="post" name="editForm" id="editForm" enctype="multipart/form-data">
                    <input type="hidden" name="title" value="<?=$Doc?>">
                    <textarea pressdo-editor name="content"><?=$raw?></textarea>
                    <p>요약</p>
                    <input pressdo-edit-summary type="text" name="summary">
                    <p><input type="checkbox" name="agree" id="agree"> <label for="agree"><?=stripslashes($conf['EditAgreeText'])?></label></p><?php
                    if (!$_SESSION['userid']) { ?>
                        <b>로그인하지 않은 상태로 편집하고 있습니다. 저장 시 아이피(<?=PressDo::getip()?>)가 영구히 기록됩니다.</b><?php
                    } ?>
                    <div pressdo-buttonarea>
                        <button pressdo-button type="button" onclick="editorMenu('preview');">미리 보기</button>
                        <button pressdo-button-blue pressdo-button style="margin-top:0; margin-left:5px;" type="button" onclick="editorMenu('save');">저장</button>
                        <script>
                        // 버튼
                        var f = document.getElementById('editForm');
                        var a = document.createElement('input');
                        a.setAttribute('type', 'hidden');
                        a.setAttribute('name', 'action');
                        function editorMenu(action) {
                            a.setAttribute('value', action);
                            f.appendChild(a);
                            document.body.appendChild(f);
                            n = document.getElementById('_pressdo-form-anchor')
                            if(action == 'preview'){
                                f.action = '<?=$uri['edit'].rawurlencode($Doc)?>';
                                var parent = n.parentNode;
                                parent.insertBefore(f, parent.childNodes[6]);
                            }
                            if(action == 'save'){
                                if(!document.editForm.agree.checked){
                                    alert('수정하기 전에 먼저 문서 배포 규정에 동의해 주세요.');
                                    var parent = n.parentNode;
                                    parent.insertBefore(f, parent.childNodes[6]);
                                    return false;
                                }
                                f.action = '<?=$uri['wiki'].rawurlencode($Doc)?>'; 
                            }
                            f.submit();
                        }
                        </script>
                    </div>
                </form><?php
                if($preview){
                    ?><p> 아래는 저장되지 않은 미리 보기의 모습입니다. </p><hr><?php
                    echo PressDo::readSyntax($raw);
                }?><?php WikiSkin::BelowContent();
        }

        public static function history($Doc, $ver){
            WikiSkin::AboveContent();?>
                <div pressdo-content-header>
                    <div pressdo-toolbar>
                        <div pressdo-toolbar-menu>
                            <a pressdo-toolbar-link href="<?=$uri['edit'].$Doc?>">편집</a>
                            <a pressdo-toolbar-link href="<?=$uri['backlink'].$Doc?>">역링크</a>
                        </div>
                    </div>
                    <h1 pressdo-doc-title><a href="<?=$uri['wiki'].$Doc?>"><span pressdo-title-namespace><?=$NS?></span><?=$Title?></a>
                        <small pressdo-doc-action>(문서 역사)</small>
                    </h1>
                </div>
                <div pressdo-history-content>
                    <form action="<?=$uri['diff'].$Doc?>">
                        <p><button pressdo-history-compare type="submit">선택 리비전 비교</button></p>
                        <div pressdo-toolbar-menu>
                            <a pressdo-history-prev>
                                <span ionicon ion-arrow-back></span>Prev
                            </a>
                            <a pressdo-history-prev>
                                Next<span ionicon ion-arrow-forward></span>
                            </a>
                        </div>
                        <ul pressdo-history>
                            <li pressdo-history>
                                <time><?=$array['savetime']?></time>
                                <span pressdo-history-menu>(<a href="/w/<?=$Doc.'?rev='.$ver?>">보기</a> | 
                                    <a href="<?=$uri['raw'].$Doc.'?rev='.$rev?>">RAW</a> | 
                                    <a href="<?=$uri['blame'].$Doc.'?rev='.$rev?>">Blame</a> | 
                                    <a href="<?=$uri['revert'].$Doc.'?rev='.$rev?>">이 리비전으로 되돌리기</a> | 
                                    <a href="<?=$uri['diff'].$Doc.'?rev='.$rev?>">비교</a><?php
            if(Data::inACLgroup($user['typename'], 'admin')){
            ?> | 
                    <a href="<?=$uri['hide'].$Doc.'?rev='.$OldData[1]['version']?>">숨기기</a><?php
            }
            ?>)
                                </span>
                                <input type="radio" name="oldrev" value="<?=$array['version']?>" style="visibility: visible;">
                                <input type="radio" name="rev" value="<?=$array['version']?>" style="visibility: visible;">
                                <strong>r<?=$array['version']?></strong> <span><?=$Differ?></span>
                                <div pressdo-history-menu style="display:inline;"><?=$User?></div>
                                (<span style="color:grey"><?=$array['summary']?></span>)</li><?php
            $from = $_GET['from'];
            if(!$_GET['from']){
                $from = 99999999999999999999999;
            }
            $minx = min(30, $array['version'], $from);
            for ($x = 1; $x < $minx; ++$x) {
                // 현재 버전 기준으로 최근 30개까지만 로드
                $OldData = Data::LoadOldDocument($Doc, $array['version'] - $x);
                $OldData2 = Data::LoadOldDocument($Doc, $array['version'] - $x-1);
                $Diff = $OldData[1]['strlen'] - $OldData2[1]['strlen'];
                $isLogin = $OldData[1]['loginedit'];

                // 바이트 수 차이 색깔 표시
                if($Diff > 0){
                    $Diff = '(<span pressdo-history-green>+'.$Diff.'</span>)';
                }elseif($Diff == 0){
                    $Diff = '(<span pressdo-history-gray>0</span>)';
                }elseif($Diff < 0){
                    $Diff = '(<span pressdo-history-red>'.$Diff.'</span>)';
                }
                if($isLogin == 1) {
                    $User = '<b>'.$OldData[1]['contributor'].'</b>';
                }else{
                    $User = $OldData[1]['contributor'];
                }
                ?><li pressdo-history><time><?=$OldData[1]['savetime']?></time> 
                <span pressdo-history-menu>(<a href="<?=$conf['ViewerUri'].$Doc.'?rev='.$OldData[1]['version']?>">보기</a> | 
                    <a href="<?=$uri['raw'].$Doc.'?rev='.$OldData[1]['version']?>">RAW</a> | 
                    <a href="<?=$uri['blame'].$Doc.'?rev='.$OldData[1]['version']?>">Blame</a> | 
                    <a href="<?=$uri['revert'].$Doc.'?rev='.$OldData[1]['version']?>">이 리비전으로 되돌리기</a> | 
                    <a href="<?=$uri['diff'].$Doc.'?rev='.$OldData[1]['version']?>">비교</a><?php
            if(Data::inAcLgroup($user['typename'], 'admin')){
            ?> | 
                    <a href="<?=$uri['hide'].$Doc.'?rev='.$OldData[1]['version']?>">숨기기</a><?php
            }
            ?>)
                </span>
                    <input type="radio" name="oldrev" value="<?=$OldData[1]['version']?>" style="visibility: visible;">
                    <input type="radio" name="rev" value="<?=$OldData[1]['version']?>" style="visibility: visible;">
                    <strong>r<?=$OldData[1]['version']?></strong> <span><?=$Diff?></span>
                    <div pressdo-history-menu style="display:inline;"><?=$User?></div>
                    (<span style="color:grey"><?=$OldData[1]['summary']?></span>)</li><?php
            } ?>
            </ul></form></div><?php WikiSkin::BelowContent();
        }
    }
}
