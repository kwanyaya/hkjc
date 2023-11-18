<!-- err locals not reactive -->


英文json 有缺失，切換可能會顯示錯誤
css 數據 盡量用rem
字體可能要bold 未set
英文fontsize好似 -2px  可以問下carol
! database column 未必是最新
安全問題，無將db.php 上傳
暫時未用
  admin 開 jwt header

<!-- register -->
v-if 會取消user data，研究用v-show 但唔好render咁多野

非public 
  注冊同check 數量未駁，未研究洗唔洗重寫
  sms 未問Vicky
public 
  當初條注冊api要拆分，分開 注冊/登入，選擇性call api 
  自行 抽取 public 數據 或 透過api分類登入/注冊
  呢到不用sd sms

tnc睇下能否模仿我當時的寫法,改動請在tnc component内進行，tnc_x.js 睇下可否改成json形式
透過不同用戶決定load 不同tnc
404 block 睇下有無其他問題



<!-- stores/group -->
router group 幫我打亂，map返數字


<!-- game -->
透過xxx-page prop傳入類型決定load咩 event，event component 如果跟我情況，自行寫 json 再決定show back,color,text

如果覺得混亂，可以直接好似event copy 取消分拆

其他組件可以參考 hkjc_old做法

<!-- api -->
對應返回/問下 public 注冊如果已經有呢個record點做，印象中有err msg

pubic login 可以用返 /user/login -> 電話號碼login

public_register 無入場券, php user_group 可能要改過