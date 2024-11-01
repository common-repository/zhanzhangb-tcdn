=== 站长帮 - WordPress CDN 管理插件 ===
Contributors: ywtywt
Donate link: https://www.zhanzhangb.cn/
Tags: Cache,Cdn
Requires at least: 5.0
Tested up to: 6.6.1
Stable tag: 1.3.1
Requires PHP: 8.1
License: GNU General Public License (GPL) version 3
License URI: https://www.gnu.org/licenses/gpl-3.0.html

插件功能：为 WordPress 网站添加自动管理 CDN 缓存的功能。在发布或更新文章、发表评论或评论被审批后自动刷新/预缓存相关URL的 CDN 缓存，目前仅支持腾讯云CDN，未来将支持更多CDN服务商。
插件作者：<a href="https://www.zhanzhangb.cn/" rel="friend">站长帮</a>

== Description ==

**插件特色：**

即时内容更新，提升用户体验

无论是新增文章、修订内容，还是产生新评论，插件都会自动触发 CDN 缓存刷新，确保内容更新即时推送至 CDN（预缓存），减少用户访问旧内容的风险，提升网站的互动性和时效性。

全面支持，覆盖核心页面

插件不仅支持文章和页面的缓存刷新，还支持首页、分类页、标签页的缓存刷新，确保网站的每一个角落都能保持最新状态，为用户提供连贯一致的浏览体验。

简易集成，操作友好

无需深奥的技术知识，通过直观的设置界面，轻松完成与腾讯云 CDN 的对接。一键安装，即刻享受自动化缓存管理带来的便利。

灵活扩展

尽管当前仅支持腾讯云 CDN，但插件设计已预留接口，未来将逐步兼容更多主流 CDN 服务商，确保您在更换或扩展 CDN 服务时，依旧能够无缝衔接，保持管理的连续性与灵活性。

更多详情：<a href="https://www.zhanzhangb.cn/wordpress-cdn-plugins" rel="friend">WordPress CDN 管理插件官网</a>

== Installation ==

This section describes how to install the plugin and get it working.

e.g.

1. Upload the plugin files to the `/wp-content/plugins/plugin-name` directory, or install the plugin through the WordPress plugins screen directly.
1. Activate the plugin through the 'Plugins' screen in WordPress
1. Use the Settings->Plugin Name screen to configure the plugin
1. (Make your instructions match the desired user flow for activating and installing your plugin. Include any steps that might be needed for explanatory purposes)


== Frequently Asked Questions ==

= 如何获得腾讯云CDN密钥？ =

腾讯云CDN 密钥获得地址：https://console.cloud.tencent.com/cam/capi

= 为什么刷新CDN缓存失败=

请先查看 CDN 后台管理中的刷新日志，如果没有相应日志，请禁用所有其它插件试试。

== Screenshots ==

1. `/assets/screenshot-1.png` 
2. `/assets/screenshot-2.png` 

== Changelog ==
= 1.3.1 =
* 修复支持链接。

= 1.3.0 =
*1、代码全部重构，执行效率更高。
*2、新增支持 CDN 预缓存。
*3、后续版本将支持其它CDN。

= 1.2.0 =
*1、新增：只有在发表新文章时才刷新首页、分类页等相关缓存，仅更新文章时，只刷新文章CDN缓存。
*2、修复已知BUG。

= 1.1.0 =
1、新增：更新文章时，如果文章有多个分类，将刷新所有分类的缓存。
2、修复计划任务发布文章刷新缓存错误的BUG。

= 1.0.6 =
如果刷新缓存失败，增加错误日志（中文），并可在后台设置页面查看。

= 1.0.5 =
如果刷新缓存失败，增加错误日志，并可在后台设置页面查看。

= 1.0.4 =
如果发布的文章类型不是post，则不刷新缓存。
修复一些BUG。

= 1.0.3 =
适配WordPress 5.4。

= 1.0.2 =
优化设置界面。

= 1.0.1 =
修复错误，规范代码。

= 1.0.0 =
* 首次正式发布
* 经过两周的测试与修正

== Upgrade Notice ==

= 1.3.0 =
重大更新。


= 1.2.0 =
新增功能；修复BUG。
请立即升级

= 1.1.0 =
新增：更新文章时，如果文章有多个分类，将刷新所有分类的缓存；修复BUG。
请立即升级

= 1.0.6 =
如果刷新缓存失败，输出中文错误日志。建议升级

= 1.0.5 =
建议升级。

= 1.0.4 =
立即升级。

= 1.0.3 =
适配WordPress 5.4。建议升级。

= 1.0.2 =
优化设置界面。立即升级。

= 1.0.1 =
修复错误，规范代码。立即升级。

= 1.0.0 =
正式发布的版本。 立即升级。


== Arbitrary section ==

隐私说明：本插件通过腾讯云 CDN 的官方API接口刷新缓存，如果使用本插件，代表您同意将URL与腾讯云密钥（SecretId与SecretKey）等信息发送至"cdn.api.qcloud.com"。

腾讯云隐私政策（Privacy Policy）：https://cloud.tencent.com/document/product/301/11470

重大贡献与技术支持：<a href="https://www.zhanzhangb.com/" rel="friend">站长帮资源站</a>

本插件由站长帮制作并发行，官网：https://www.zhanzhangb.cn/
