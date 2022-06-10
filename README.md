# TetrioRatingColor
利用Shields.io，实现按颜色显示tetr.io的Rating
## 现成的API
国际惯例，先丢API：https://rin.kagamine.xyz:16300/tetr.php


## 使用方法


以下是三个示例：**由于启用了longCache，第一次调用时可能较慢**    

https://rin.kagamine.xyz:16300/tetr.php?user=nili
![](https://rin.kagamine.xyz:16300/tetr.php?user=nili) （这个是作者的账号哦qwq）

https://rin.kagamine.xyz:16300/tetr.php?user=blaarg
![](https://rin.kagamine.xyz:16300/tetr.php?user=blaarg)

https://rin.kagamine.xyz:16300/tetr.php?user=hibari233&style=flat-square
![](https://rin.kagamine.xyz:16300/tetr.php?user=hibari233&style=flat-square)

没打满十场会显示胜场/总场，因为RD过高没有rank会显示问号rank。

参数如您所见：   


user：您想要获取的用户 **用户名必须使用小写**   
style：Shields.io的主题，可以不填，默认是for-the-badge   
**更多主题字符串可去[https://shields.io](https://shields.io)查看！**  

**新版更新资瓷了缩写：**
使用st函数传入，不可与style传入重用。  
目前手工定义：  
- f1 -> flat
- f2 -> flat-square



## 在自己服务器上搭建
就一个php文件，clone下来用就行。

## 原理
使用ch.tetr.io的API来获取用户的Rating。    
之后判断好颜色，然后302到Shields.io，输出svg图片。   


**由于本API依赖以上两个服务，因此上述服务中任意一个出现问题，该API将无法使用！**

## 最后
这是我从深夜肝到凌晨的成果，先在此求个**star**先。  
该API的运行离不开ch.tetr.io和Shields.io的API提供，向他们致以诚挚的感谢。


**感谢原项目CFRatingColor的作者abc1763613206和Anguei，我这项目基本都是从那边抄来改的。**  

原项目链接：[https://github.com/hanlin-studio/CFRatingColor](https://github.com/hanlin-studio/CFRatingColor)

