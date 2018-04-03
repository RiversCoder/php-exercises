## 使用PHP做一些有趣的小实验 

### phone.php 

* submail第三方api接口
* curl请求该接口，发送数据到第三方平台
* 再由第三方平台发送验证码到用户手机 

### sdkPhone.php

* 使用 submail SDK 实现短信验证码到用户
* 直接调用MESSAGEXsend类中的方法 实现发送短信
