import{c as U,f as H,v as N,u as b}from"./links.Ce9S4kjc.js";import{a as P}from"./addons.DW40jBC1.js";import{g as L}from"./params.B3T1WKlC.js";import{U as Z}from"./Url.C2Kwu4F0.js";import{C as q,b as B,S as O}from"./Caret.BthVBOwE.js";import{C as I}from"./Index.hENYR9Tl.js";import{C as T}from"./Tooltip.DhkkBQWW.js";import{v as c,o as s,c as a,a as n,m as k,t as o,b as r,k as p,l,C as _,G as w,B as u,E as F}from"./runtime-dom.esm-bundler.tPRhSV4q.js";import{_ as m}from"./_plugin-vue_export-helper.BN1snXvA.js";const Y={setup(){return{addonsStore:U(),licenseStore:H(),pluginsStore:N(),rootStore:b()}},mixins:[Z],components:{CoreAlert:q,CoreLoader:B,CoreModal:I,CoreTooltip:T,SvgClose:O},props:{feature:{type:Object,required:!0},canActivate:{type:Boolean,default(){return!0}},canManage:{type:Boolean,default(){return!1}},staticCard:Boolean},data(){return{addons:P,addon:{},showNetworkModal:!1,changeStatusOnNetwork:!1,failed:!1,loading:!1,featureUpgrading:!1,strings:{version:this.$t.__("Version",this.$td),updateToVersion:this.$t.__("Update to version",this.$td),activated:this.$t.__("Activated",this.$td),networkActivated:this.$t.__("Network Activated",this.$td),deactivated:this.$t.__("Deactivated",this.$td),notInstalled:this.$t.__("Not Installed",this.$td),upgradeToPro:this.$t.__("Upgrade to Pro",this.$td),upgradeYourPlan:this.$t.__("Upgrade Your Plan",this.$td),updateFeature:this.$t.__("Update Addon",this.$td),permissionWarning:this.$t.__("You currently don't have permission to update this addon. Please ask a site administrator to update.",this.$td),manage:this.$t.__("Manage",this.$td),requestFailed:this.$t.__("An error occurred while changing the addon status. Please try again or contact support for more information.",this.$td),updateRequired:this.$t.sprintf(this.$t.__("An update is required for this addon to continue to work with %1$s %2$s.",this.$td),"AIOSEO","Pro"),areYouSureNetworkChange:this.$t.__("This is a network-wide change.",this.$td),yesProcessNetworkChange:this.$t.__("Yes, process this network change",this.$td),noChangedMind:this.$t.__("No, I changed my mind",this.$td)}}},computed:{networkChangeMessage(){return this.addon.isActive?this.$t.__("Are you sure you want to activate this addon across the network?",this.$td):this.$t.__("Are you sure you want to deactivate this addon across the network?",this.$td)},statusLabel(){return this.addon.isActive?!this.rootStore.aioseo.data.isNetworkAdmin&&this.addon.isNetworkActive?this.strings.networkActivated:this.strings.activated:this.addon.installed||this.addon.canInstall?this.strings.deactivated:this.strings.notInstalled}},methods:{closeNetworkModal(t){this.changeStatusOnNetwork=t,this.showNetworkModal=!1},processStatusChange(t){if(this.addon.isActive=t,this.rootStore.aioseo.data.isNetworkAdmin){this.showNetworkModal=!0;return}this.actuallyProcessStatusChange()},actuallyProcessStatusChange(){this.failed=!1,this.loading=!0;const t=this.addon.isActive?"installPlugins":"deactivatePlugins";this.pluginsStore[t]([{plugin:this.addon.basename}]).then(i=>{this.loading=!1,i.body.failed.length&&(this.addon.isActive=!this.addon.isActive,this.failed=!0)}).catch(()=>{this.loading=!1,this.addon.isActive=!this.addon.isActive})},processUpgradeFeature(){this.failed=!1,this.featureUpgrading=!0,this.pluginsStore.upgradePlugins([{plugin:this.addon.sku}]).then(t=>{if(this.featureUpgrading=!1,t.body.failed.length){this.addon.isActive=!1,this.failed=!0;return}this.addon=this.addons.getAddon(this.addon.sku)}).catch(()=>{this.featureUpgrading=!1,this.addon.isActive=!1})}},watch:{showNetworkModal(t){if(t){this.changeStatusOnNetwork=!1;return}this.changeStatusOnNetwork||(this.addon.isActive=!this.addon.isActive),this.changeStatusOnNetwork&&this.actuallyProcessStatusChange()}},mounted(){this.addon=this.addons.getAddon(this.feature.sku);const t=L();!this.addon.isActive&&t["aioseo-activate"]&&t["aioseo-activate"]===this.addon.sku&&(this.loading=!0,this.addon.isActive=!0,this.pluginsStore.installPlugins([{plugin:this.addon.basename}]).then(()=>this.loading=!1).catch(()=>{this.loading=!1,this.addon.isActive=!this.addon.isActive}))}},x={class:"aioseo-feature-card"},R={class:"feature-card-header"},$={class:"feature-card-description"},z={key:0,class:"learn-more"},E=["href"],G=["href"],D={key:1,class:"learn-more"},W=["href"],j=["href"],J={key:0,class:"feature-card-install-activate"},K={key:1,class:"version"},Q={class:"status"},X={key:1,class:"feature-card-upgrade-cta"},ee={key:0},te={key:1},se={key:2,class:"feature-card-upgrade-cta"},oe={class:"version"},ne={key:0},ie={class:"aioseo-modal-body"},re={class:"reset-description"};function ae(t,i,h,v,e,d){const C=c("core-alert"),y=c("core-loader"),A=c("base-toggle"),f=c("base-button"),S=c("core-tooltip"),V=c("svg-close"),M=c("core-modal");return s(),a("div",x,[n("div",{class:w(["feature-card-body",{static:h.staticCard}])},[n("div",R,[k(t.$slots,"title")]),n("div",$,[k(t.$slots,"description"),(!e.addon.isActive||e.addon.requiresUpgrade)&&!h.staticCard?(s(),a("div",z,[n("a",{href:t.$links.utmUrl("feature-manager-addon-link",e.addon.sku,e.addon.learnMoreUrl),target:"_blank"},o(t.$constants.GLOBAL_STRINGS.learnMore),9,E),n("a",{href:t.$links.utmUrl("feature-manager-addon-link",e.addon.sku,e.addon.learnMoreUrl),class:"no-underline",target:"_blank"}," →",8,G)])):r("",!0),e.addon.manageUrl&&(e.addon.isActive&&!e.addon.requiresUpgrade||h.staticCard)&&h.canManage?(s(),a("div",D,[n("a",{href:t.getHref(e.addon.manageUrl)},o(e.strings.manage),9,W),n("a",{href:t.getHref(e.addon.manageUrl),class:"no-underline"}," → ",8,j)])):r("",!0),e.failed?(s(),p(C,{key:2,class:"install-failed",type:"red"},{default:l(()=>[_(o(e.strings.requestFailed),1)]),_:1})):r("",!0)])],2),h.canActivate?(s(),a("div",{key:0,class:w(["feature-card-footer",{"upgrade-required":e.addon.requiresUpgrade||!v.licenseStore.license.isActive}])},[!e.addon.requiresUpgrade&&v.licenseStore.license.isActive&&(!e.addon.installed||e.addon.hasMinimumVersion)?(s(),a("div",J,[e.loading?(s(),p(y,{key:0,dark:""})):r("",!0),!e.loading&&e.addon.installedVersion?(s(),a("span",K,o(e.strings.version)+" "+o(e.addon.installedVersion),1)):r("",!0),n("span",Q,o(d.statusLabel),1),e.addon.installed||e.addon.canInstall?(s(),p(A,{key:2,modelValue:e.addon.isActive,disabled:e.loading,"onUpdate:modelValue":i[0]||(i[0]=g=>d.processStatusChange(g))},null,8,["modelValue","disabled"])):r("",!0)])):r("",!0),e.addon.requiresUpgrade||!v.licenseStore.license.isActive?(s(),a("div",X,[u(f,{type:"green",size:"medium",tag:"a",href:t.$links.getUpsellUrl("feature-manager-upgrade",e.addon.sku,t.$isPro?"pricing":"liteUpgrade"),target:"_blank"},{default:l(()=>[t.$isPro?(s(),a("span",ee,o(e.strings.upgradeYourPlan),1)):r("",!0),t.$isPro?r("",!0):(s(),a("span",te,o(e.strings.upgradeToPro),1))]),_:1},8,["href"])])):r("",!0),t.$isPro&&!e.addon.requiresUpgrade&&e.addon.installed&&!e.addon.hasMinimumVersion?(s(),a("div",se,[e.addon.isActive&&!e.loading?(s(),p(S,{key:0},{tooltip:l(()=>[_(o(e.strings.updateRequired)+" ",1),e.addons.userCanUpdate(e.addon.sku)?r("",!0):(s(),a("strong",ne,o(e.strings.permissionWarning),1))]),default:l(()=>[n("span",oe,o(e.strings.updateToVersion)+" "+o(e.addon.minimumVersion),1)]),_:1})):r("",!0),u(f,{type:"blue",size:"medium",onClick:d.processUpgradeFeature,loading:e.featureUpgrading,disabled:!e.addons.userCanUpdate(e.addon.sku)},{default:l(()=>[_(o(e.strings.updateFeature),1)]),_:1},8,["onClick","loading","disabled"])])):r("",!0)],2)):r("",!0),u(M,{show:e.showNetworkModal,"no-header":"",onClose:i[4]||(i[4]=g=>d.closeNetworkModal(!1)),classes:["aioseo-feature-card-modal"]},{body:l(()=>[n("div",ie,[n("button",{class:"close",onClick:i[1]||(i[1]=F(g=>d.closeNetworkModal(!1),["stop"]))},[u(V)]),n("h3",null,o(e.strings.areYouSureNetworkChange),1),n("div",re,o(d.networkChangeMessage),1),u(f,{type:"blue",size:"medium",onClick:i[2]||(i[2]=g=>d.closeNetworkModal(!0))},{default:l(()=>[_(o(e.strings.yesProcessNetworkChange),1)]),_:1}),u(f,{type:"gray",size:"medium",onClick:i[3]||(i[3]=g=>d.closeNetworkModal(!1))},{default:l(()=>[_(o(e.strings.noChangedMind),1)]),_:1})])]),_:1},8,["show"])])}const Le=m(Y,[["render",ae]]),de={},le={viewBox:"0 0 24 24",fill:"none",xmlns:"http://www.w3.org/2000/svg"},ce=n("path",{"fill-rule":"evenodd","clip-rule":"evenodd",d:"M11 15H7C5.35 15 4 13.65 4 12C4 10.35 5.35 9 7 9H11V7H7C4.24 7 2 9.24 2 12C2 14.76 4.24 17 7 17H11V15ZM17 7H13V9H17C18.65 9 20 10.35 20 12C20 13.65 18.65 15 17 15H13V17H17C19.76 17 22 14.76 22 12C22 9.24 19.76 7 17 7ZM16 11H8V13H16V11Z",fill:"currentColor"},null,-1),ue=[ce];function he(t,i){return s(),a("svg",le,ue)}const Ze=m(de,[["render",he]]),ge={},_e={viewBox:"0 0 24 24",fill:"none",xmlns:"http://www.w3.org/2000/svg",class:"aioseo-redirect"},fe=n("path",{"fill-rule":"evenodd","clip-rule":"evenodd",d:"M10.59 9.17L5.41 4L4 5.41L9.17 10.58L10.59 9.17ZM14.5 4L16.54 6.04L4 18.59L5.41 20L17.96 7.46L20 9.5V4H14.5ZM13.42 14.82L14.83 13.41L17.96 16.54L20 14.5V20H14.5L16.55 17.95L13.42 14.82Z",fill:"currentColor"},null,-1),pe=[fe];function me(t,i){return s(),a("svg",_e,pe)}const qe=m(ge,[["render",me]]),ve={},ke={viewBox:"0 0 28 28",fill:"none",xmlns:"http://www.w3.org/2000/svg",class:"aioseo-sitemaps-pro"},we=n("path",{"fill-rule":"evenodd","clip-rule":"evenodd",d:"M23.45 3.5H4.55C3.96667 3.5 3.5 3.96667 3.5 4.55V23.45C3.5 23.9167 3.96667 24.5 4.55 24.5H23.45C23.9167 24.5 24.5 23.9167 24.5 23.45V4.55C24.5 3.96667 23.9167 3.5 23.45 3.5ZM10.5 8.16667H8.16667V10.5H10.5V8.16667ZM19.8333 8.16667H12.8333V10.5H19.8333V8.16667ZM19.8333 12.8333H12.8333V15.1667H19.8333V12.8333ZM12.8333 17.5H19.8333V19.8333H12.8333V17.5ZM8.16667 12.8333H10.5V15.1667H8.16667V12.8333ZM10.5 17.5H8.16667V19.8333H10.5V17.5ZM5.83333 22.1667H22.1667V5.83333H5.83333V22.1667Z",fill:"currentColor"},null,-1),Ce=[we];function ye(t,i){return s(),a("svg",ke,Ce)}const Be=m(ve,[["render",ye]]);export{Le as C,Ze as S,qe as a,Be as b};
