//
//  SettingViewController.m
//  app
//
//  Created by Rocks on 16/4/24.
//  Copyright © 2016年 jiafenzhushou. All rights reserved.
//

#define kCellIdentifier_Setting_Text @"Setting_Cell"


#import "SettingViewController.h"
#import <CommonCrypto/CommonDigest.h>
#import "SettingCell.h"
#import "UITableView+Common.h"
#import "DES3Util.h"

@interface SettingViewController ()<UITableViewDelegate, UITableViewDataSource>
@property (nonatomic, strong) UITextField* activeCodeText;
@property (nonatomic, strong) UIImageView* headImageView;
@property (nonatomic, strong) UIView *headerView;
@property (nonatomic, strong) UIView *activeAreaView;
@property (nonatomic, strong) UITableView *settingTableView;
@property (nonatomic, strong) UILabel *uidLabel;
@property (nonatomic, strong) UIButton *cpButton;
@property (nonatomic, strong) UILabel *activedLabel;
@property (nonatomic,strong) UIButton *activeCodeButton;
@end

@implementation SettingViewController

- (void)viewDidLoad {
    [super viewDidLoad];
    
     
    UIImageView *titleImageView=[[UIImageView alloc]initWithImage:[UIImage imageNamed:@"setting_title_logo"]];
    self.navigationItem.titleView=titleImageView;
    
    _headerView=[UIView new];
    UIView *settingView=[UIView new];
    
    [self.view setBackgroundColor:[UIColor colorWithHexString:@"0xffffff"]];
    _headerView.backgroundColor=kNavBackground;
    
    if(![self isActived])
    {
        
        _activeAreaView=[[UIView alloc]init];
        _activeAreaView.backgroundColor=[UIColor colorWithHexString:@"0xffffff"];
        _activeAreaView.layer.masksToBounds = YES;
        _activeAreaView.layer.cornerRadius = 4.0;
        
        _activeCodeText=[[UITextField alloc]init];
        _activeCodeText.font = [UIFont boldSystemFontOfSize:20];
        _activeCodeText.textColor = [UIColor colorWithHexString:@"0xffffff"];
        _activeCodeText.textAlignment = NSTextAlignmentLeft;
        _activeCodeText.placeholder=@"请输入激活码";
        _activeCodeText.backgroundColor=[UIColor colorWithHexString:@"0xffffff"];
        
        
        
        UIImageView *cityLeftview=[[UIImageView alloc]initWithImage:[UIImage imageNamed:@"setting_activate_button"]];
        _activeCodeText.leftViewMode = UITextFieldViewModeAlways;
        _activeCodeText.leftView = cityLeftview;
        [_activeCodeText setTextColor:[UIColor blackColor]];
     
        [_activeAreaView addSubview:_activeCodeText];
        
       
        
        _activeCodeButton = [[UIButton alloc] init];
        [_activeCodeButton.titleLabel setFont:[UIFont systemFontOfSize:18]];
        [_activeCodeButton setTitleColor:[UIColor whiteColor] forState:UIControlStateNormal];
        [_activeCodeButton setTitleColor:[UIColor colorWithWhite:1.0 alpha:0.5] forState:UIControlStateHighlighted];
        [_activeCodeButton setTitle:@"激活" forState:UIControlStateNormal];
        [_activeCodeButton setBackgroundImage:[UIImage imageWithColor:[UIColor colorWithHexString:@"0xd35400"]] forState:UIControlStateNormal];
        [_activeCodeButton.layer setMasksToBounds:YES];
        [_activeCodeButton addTarget:self action:@selector(activeApp) forControlEvents:UIControlEventTouchUpInside];
        [_activeAreaView addSubview:_activeCodeButton];
     
        
        
         [_headerView addSubview:_activeAreaView];
        
        
        _uidLabel=[UILabel new];
        [_uidLabel setFont:[UIFont systemFontOfSize:18]];
        [_uidLabel setTextColor:[UIColor whiteColor]];
        [_uidLabel setText:[NSString stringWithFormat:@"设备号:%@",[self getUid]]];
        
        _cpButton=[UIButton new];
        [_cpButton.titleLabel setFont:[UIFont systemFontOfSize:18]];
        [_cpButton.titleLabel setTextColor:[UIColor whiteColor]];
        [_cpButton setTitle:@"复制" forState:UIControlStateNormal];;
        [_cpButton addTarget:self action:@selector(copyAppUID) forControlEvents:UIControlEventTouchUpInside];
        [_headerView addSubview:_uidLabel];
        [_headerView addSubview:_cpButton];
        
    }else
    {
        _headImageView=[[UIImageView alloc]initWithImage:[UIImage imageNamed:@"head"]];
        _activedLabel=[UILabel new];
        [_activedLabel setFont:[UIFont systemFontOfSize:18]];
        [_activedLabel setTextColor:[UIColor whiteColor]];
        [_activedLabel setText:@"已激活"];
        [_headerView addSubview:_headImageView];
        [_headerView addSubview:_activedLabel];
        
    }
    
    _settingTableView= [[UITableView alloc] initWithFrame:settingView.bounds style:UITableViewStylePlain];
    _settingTableView.backgroundColor = [UIColor clearColor];
    _settingTableView.delegate = self;
    _settingTableView.dataSource = self;
    _settingTableView.separatorStyle = UITableViewCellSeparatorStyleNone;
    [_settingTableView registerClass:[SettingCell class] forCellReuseIdentifier:kCellIdentifier_Setting_Text];
    [settingView addSubview:_settingTableView];
    
    
    
    [self.view addSubview:_headerView];
    [self.view addSubview:settingView];
    
    [_headerView mas_makeConstraints:^(MASConstraintMaker *make) {
        make.left.right.top.equalTo(self.view);
        make.height.mas_equalTo(180);
    }];
    
    if (![self isActived]) {
        
        [_activeAreaView mas_makeConstraints:^(MASConstraintMaker *make) {
            
            make.height.mas_equalTo(48);
            make.width.mas_equalTo(kScreen_Width -20);
            make.centerX.mas_equalTo(_headerView.mas_centerX);
            make.top.equalTo(_headerView.mas_top).with.offset(20);
        }];
        [_activeCodeText mas_makeConstraints:^(MASConstraintMaker *make) {
            
            make.height.mas_equalTo(48);
            make.width.mas_equalTo(kScreen_Width-100);
            make.left.mas_equalTo(_activeAreaView.mas_left);
            make.top.equalTo(_activeAreaView.mas_top);
        }];
        
        [_activeCodeButton mas_makeConstraints:^(MASConstraintMaker *make) {
            make.height.mas_equalTo(48);
            make.width.mas_equalTo(80);
            make.right.mas_equalTo(_activeAreaView.right);
            make.bottom.mas_equalTo(_activeAreaView.bottom);
        }];
        
        [_uidLabel mas_makeConstraints:^(MASConstraintMaker *make) {
            make.height.mas_equalTo(48);
            make.width.mas_equalTo(kScreen_Width -80);
            make.left.equalTo(_headerView.mas_left).offset(10);
            make.bottom.equalTo(_headerView.mas_bottom).with.offset(-24);
        }];
        [_cpButton mas_makeConstraints:^(MASConstraintMaker *make) {
            make.height.mas_equalTo(48);
            make.right.equalTo(_headerView.mas_right).offset(-10);
            make.bottom.equalTo(_headerView.mas_bottom).with.offset(-24);
            
        }];
        
    }else
    {
        [_headImageView mas_makeConstraints:^(MASConstraintMaker *make) {
            
            make.height.mas_equalTo(80);
            make.width.mas_equalTo(80);
            make.centerX.mas_equalTo(_headerView.mas_centerX);
            make.centerY.mas_equalTo(_headerView.mas_centerY).offset(-30);
        }];
        [_activedLabel mas_makeConstraints:^(MASConstraintMaker *make) {
            
            make.centerX.mas_equalTo(_headerView.mas_centerX);
            make.top.mas_equalTo(_headImageView.mas_bottom).offset(20);
        }];
        
    }
    
    [settingView mas_makeConstraints:^(MASConstraintMaker *make) {
        make.width.mas_equalTo(kScreen_Width);
        make.height.mas_equalTo(kScreen_Height-224);
        make.top.mas_equalTo(_headerView.mas_bottom);
    }];
    
    [_settingTableView mas_makeConstraints:^(MASConstraintMaker *make) {
        make.width.mas_equalTo(kScreen_Width);
        make.height.mas_equalTo(kScreen_Height-224);
        make.top.mas_equalTo(_headerView.mas_bottom);
        
    }];
    
    UITapGestureRecognizer *tap = [[UITapGestureRecognizer alloc]initWithTarget:self action:@selector(reKeyBoard)];
    [self.view addGestureRecognizer:tap];
    
}

-(void) activedView
{
    [_activeAreaView removeFromSuperview];
    [_activedLabel removeFromSuperview];
    [_uidLabel removeFromSuperview];
    [_cpButton removeFromSuperview];
    
    _headImageView=[[UIImageView alloc]initWithImage:[UIImage imageNamed:@"head"]];
    _activedLabel=[UILabel new];
    [_activedLabel setFont:[UIFont systemFontOfSize:18]];
    [_activedLabel setTextColor:[UIColor whiteColor]];
    [_activedLabel setText:@"已激活"];
    [_headerView addSubview:_headImageView];
    [_headerView addSubview:_activedLabel];
    
    [_headImageView mas_makeConstraints:^(MASConstraintMaker *make) {
        
        make.height.mas_equalTo(80);
        make.width.mas_equalTo(80);
        make.centerX.mas_equalTo(_headerView.mas_centerX);
        make.centerY.mas_equalTo(_headerView.mas_centerY).offset(-30);
    }];
    [_activedLabel mas_makeConstraints:^(MASConstraintMaker *make) {
        
        
        make.centerX.mas_equalTo(_headerView.mas_centerX);
        make.top.mas_equalTo(_headImageView.mas_bottom).offset(20);
    }];
    
    
    
}



//实现方法//取消textView ,textField的第一响应者即可
- (void)reKeyBoard
{
    [_activeCodeText resignFirstResponder];
    
    
}
-(void)copyAppUID
{
    UIPasteboard *pasteboard = [UIPasteboard generalPasteboard];
    pasteboard.string = [self getUid];
    
    [self.view makeToast:@"复制成功"
                duration:2.0
                position:CSToastPositionCenter];
}
-(void) activeApp
{
    
    NSString *encode=[DES3Util encrypt:[self getUid]];
    NSString *code=_activeCodeText.text;
    if ([code isEqualToString:@""]) {
        [self.view makeToast:@"请输入激活码"
                    duration:2.0
                    position:CSToastPositionCenter];
        return;
    }
    
    if([code isEqualToString:encode])
    {
        [[NSUserDefaults standardUserDefaults] setBool:true forKey:@"encode"];
        [self.view makeToast:@"激活成功"
                    duration:2.0
                    position:CSToastPositionCenter];
        [self activedView];
        return;
        
    }else{
        [self.view makeToast:@"激活码错误"
                    duration:2.0
                    position:CSToastPositionCenter];
        return;
    }
}
-(NSString*) getUid
{
    NSString *appuid= [[NSUserDefaults standardUserDefaults] stringForKey:@"appuid"];
    if (!appuid) {
        NSDateFormatter *dateFormatter = [[NSDateFormatter alloc] init];
        [dateFormatter setDateFormat:@"yyyy-MM-dd HH:mm:ss.SSSSSS"];
        NSString *time = [dateFormatter stringFromDate:[NSDate date]];
        appuid=[self md5:time];
        [[NSUserDefaults standardUserDefaults] setValue:appuid forKey:@"appuid"];
    }
    return appuid;
}
-(NSString *)md5:(NSString *)str {
    const char *cStr = [str UTF8String];
    unsigned char result[16];
    CC_MD5( cStr, (CC_LONG)strlen(cStr), result );
    return [NSString stringWithFormat:
            @"%02X%02X%02X%02X%02X%02X%02X%02X%02X%02X%02X%02X%02X%02X%02X%02X",
            result[0], result[1], result[2], result[3],
            result[4], result[5], result[6], result[7],
            result[8], result[9], result[10], result[11],
            result[12], result[13], result[14], result[15]
            ];
}
- (NSInteger)tableView:(UITableView *)tableView numberOfRowsInSection:(NSInteger)section{
    return 6;
}

- (CGFloat)tableView:(UITableView *)tableView heightForRowAtIndexPath:(NSIndexPath *)indexPath {
    return 60.0;
}



- (UITableViewCell *)tableView:(UITableView *)tableView cellForRowAtIndexPath:(NSIndexPath *)indexPath {
    SettingCell *cell = [tableView dequeueReusableCellWithIdentifier: kCellIdentifier_Setting_Text forIndexPath:indexPath];
    
    switch (indexPath.row) {
        case 0:
            [cell setTitleStr:@"反馈意见"];
            break;
        case 1:
            [cell setTitleStr:@"检查更新"];
            break;
        case 2:
            [cell setTitleStr:@"加入QQ群"];
            break;
        case 3:
            [cell setTitleStr:@"购买软件"];
            break;
        case 4:
            
            [cell setTitleStr:@"公众号:ikoudaikong"];
            break;
        case 5:
            
            [cell setTitleStr:[NSString stringWithFormat:@"当前版本:%@",[[NSBundle mainBundle] objectForInfoDictionaryKey:@"CFBundleShortVersionString"]]];
            break;
    }
    [_settingTableView addLineforPlainCell:cell forRowAtIndexPath:indexPath withLeftSpace:0.0];
    return cell;
}
- (void)tableView:(UITableView *)tableView didSelectRowAtIndexPath:(NSIndexPath *)indexPath {
    
    [tableView deselectRowAtIndexPath:indexPath animated:YES];
    switch (indexPath.row) {
        case 0:
            [self feedBack];
            break;
        case 1:
            [self updateVersion];
            break;
        case 2:
            [self joinGroup];
            break;
        case 3:
            [self buyApp];
            break;
            
    }
}

- (void)dealloc
{
    _settingTableView.delegate = nil;
    _settingTableView.dataSource = nil;
}


-(BOOL)updateVersion
{
    NSString *urlStr = @"http://www.jiafenzhuzhou.com/mobile/feedback";
    NSURL *url = [NSURL URLWithString:urlStr];
    if([[UIApplication sharedApplication] canOpenURL:url]){
        [[UIApplication sharedApplication] openURL:url];
        return YES;
    }
    else return NO;
}

-(BOOL)buyApp
{
    NSString *urlStr = @"http://www.jiafenzhuzhou.com/mobile/buy";
    NSURL *url = [NSURL URLWithString:urlStr];
    if([[UIApplication sharedApplication] canOpenURL:url]){
        [[UIApplication sharedApplication] openURL:url];
        return YES;
    }
    else return NO;
}

-(BOOL)feedBack
{
    NSString *urlStr = @"http://www.jiafenzhuzhou.com/mobile/feedback";
    NSURL *url = [NSURL URLWithString:urlStr];
    if([[UIApplication sharedApplication] canOpenURL:url]){
        [[UIApplication sharedApplication] openURL:url];
        return YES;
    }
    else return NO;
}

- (BOOL)joinGroup{
    NSString *urlStr = @"http://www.jiafenzhuzhou.com/mobile/qun";
    NSURL *url = [NSURL URLWithString:urlStr];
    if([[UIApplication sharedApplication] canOpenURL:url]){
        [[UIApplication sharedApplication] openURL:url];
        return YES;
    }
    else return NO;
}



@end
