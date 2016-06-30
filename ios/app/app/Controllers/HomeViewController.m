//
//  HomeViewController.m
//  app
//
//  Created by Rocks on 16/4/24.
//  Copyright © 2016年 jiafenzhushou. All rights reserved.
//

#import "HomeViewController.h"
#import "MBProgressHUD.h"
#import "KTSContactsManager.h"
#import "RootTabViewController.h"


@interface HomeViewController ()
@property(strong,nonatomic) UIView *headView;
@property(strong,nonatomic) UIView *buttonView;
@property(strong,nonatomic)UILabel *numTextLabel;
@property(strong,nonatomic)UILabel *storeTextLabel;
@property(strong,nonatomic)     UITextField *importNumText;

@property (strong, nonatomic) KTSContactsManager *contactsManager;

@end

@implementation HomeViewController

- (void)viewDidLoad {
    [super viewDidLoad];
    
    self.contactsManager = [KTSContactsManager sharedManager];
    [self initView];
    
}
- (void)viewWillAppear:(BOOL)animated
{
    [super viewWillAppear:animated];
    NSInteger data_number=[[NSUserDefaults standardUserDefaults] integerForKey:@"data_count"];
    _storeTextLabel.text = [[NSNumber numberWithInteger:data_number] stringValue];
    
    NSInteger import_number=[[NSUserDefaults standardUserDefaults] integerForKey:@"import_count"];
    _numTextLabel.text = [[NSNumber numberWithInteger:import_number] stringValue];
    
}
- (void)didReceiveMemoryWarning {
    [super didReceiveMemoryWarning];
    
}
#pragma mark - HeaderView
-(void) initView
{
    UIView *headerView=[UIView new];
    
    UIView *buttonView=[UIView new];
    
    self.view.backgroundColor=kNavBackground;
    
    UIImageView *titleImageView=[[UIImageView alloc]initWithImage:[UIImage imageNamed:@"home_title_logo"]];
    self.navigationItem.titleView=titleImageView;
    
    
    UILabel *numLabel = [[UILabel alloc] init];
    numLabel.font = [UIFont boldSystemFontOfSize:20];
    numLabel.textColor = [UIColor colorWithHexString:@"0xffffff"];
    numLabel.textAlignment = NSTextAlignmentCenter;
    numLabel.text = @"号码库数量";
    [headerView addSubview:numLabel];
    
    UILabel *storeLabel = [[UILabel alloc] init];
    storeLabel.font = [UIFont boldSystemFontOfSize:20];
    storeLabel.textColor = [UIColor colorWithHexString:@"0xffffff"];
    storeLabel.textAlignment = NSTextAlignmentCenter;
    storeLabel.text = @"导入数量";
    [headerView addSubview:storeLabel];
    
    
    _numTextLabel = [[UILabel alloc] init];
    _numTextLabel.font = [UIFont boldSystemFontOfSize:20];
    _numTextLabel.textColor = [UIColor colorWithHexString:@"0xffffff"];
    _numTextLabel.textAlignment = NSTextAlignmentCenter;
    [headerView addSubview:_numTextLabel];
    
    _storeTextLabel = [[UILabel alloc] init];
    _storeTextLabel.font = [UIFont boldSystemFontOfSize:20];
    _storeTextLabel.textColor = [UIColor colorWithHexString:@"0xffffff"];
    _storeTextLabel.textAlignment = NSTextAlignmentCenter;
    [headerView addSubview:_storeTextLabel];
    
    _importNumText=[[UITextField alloc]init];
    _importNumText.font = [UIFont boldSystemFontOfSize:20];
    _importNumText.textColor = [UIColor colorWithHexString:@"0xffffff"];
    _importNumText.textAlignment = NSTextAlignmentLeft;
    _importNumText.keyboardType = UIKeyboardTypeNumberPad;
    _importNumText.placeholder=@"导入数量不超过1000";
    _importNumText.backgroundColor=[UIColor colorWithHexString:@"0xffffff"];
    
    
    UIImageView *leftview=[[UIImageView alloc]initWithImage:[UIImage imageNamed:@"import_data_icon"]];
    _importNumText.leftViewMode = UITextFieldViewModeAlways;
    _importNumText.leftView = leftview;
    [_importNumText setTextColor:[UIColor blackColor]];
    [_importNumText.layer setCornerRadius:4];
    [headerView addSubview:_importNumText];
    
    UIButton *importButton = [[UIButton alloc] init];
    [importButton.titleLabel setFont:[UIFont systemFontOfSize:18]];
    [importButton setTitleColor:[UIColor whiteColor] forState:UIControlStateNormal];
    [importButton setTitleColor:[UIColor colorWithWhite:1.0 alpha:0.5] forState:UIControlStateHighlighted];
    [importButton setTitle:@"导入" forState:UIControlStateNormal];
    [importButton setBackgroundImage:[UIImage imageWithColor:[UIColor colorWithHexString:@"0xd35400"]] forState:UIControlStateNormal];
    [importButton.layer setMasksToBounds:YES];
    [importButton addTarget:self action:@selector(importNumber) forControlEvents:UIControlEventTouchUpInside];
    [_importNumText addSubview:importButton];
    
    
    UIButton *clearContactButton = [[UIButton alloc] init];
    
    UIImageView *clearContactImageView=[[UIImageView alloc]initWithImage:[UIImage imageNamed:@"home_clear_contact_icon"]];
    [clearContactButton addSubview:clearContactImageView];
    [clearContactButton.titleLabel setFont:[UIFont systemFontOfSize:18]];
    [clearContactButton setTitleColor:[UIColor whiteColor] forState:UIControlStateNormal];
    [clearContactButton setTitle:@"清除通讯录" forState:UIControlStateNormal];
    [clearContactButton addTarget:self action:@selector(clearContacts) forControlEvents:UIControlEventTouchUpInside];
    [clearContactButton setTitleEdgeInsets:UIEdgeInsetsMake(40, 0, 0, 0)];
    [clearContactButton.layer setMasksToBounds:YES];
    [buttonView addSubview:clearContactButton];
    
    
    UIButton *clearHistoryButton = [[UIButton alloc] init];
    
    UIImageView *clearHistoryImageView=[[UIImageView alloc]initWithImage:[UIImage imageNamed:@"home_clear_history_icon"]];
    [clearHistoryButton addSubview:clearHistoryImageView];
    [clearHistoryButton.titleLabel setFont:[UIFont systemFontOfSize:18]];
    [clearHistoryButton setTitleColor:[UIColor whiteColor] forState:UIControlStateNormal];
    [clearHistoryButton setTitle:@"清除历史记录" forState:UIControlStateNormal];
    [clearHistoryButton setTitleEdgeInsets:UIEdgeInsetsMake(40, 0, 0, 0)];
    [clearHistoryButton.layer setMasksToBounds:YES];
    [clearHistoryButton addTarget:self action:@selector(clearHistory) forControlEvents:UIControlEventTouchUpInside];
    [buttonView addSubview:clearHistoryButton];
    
    UIButton *importContactButton = [[UIButton alloc] init];
    
    UIImageView *importContactImageView=[[UIImageView alloc]initWithImage:[UIImage imageNamed:@"home_update_contact_icon"]];
    [importContactButton addSubview:importContactImageView];
    [importContactButton.titleLabel setFont:[UIFont systemFontOfSize:18]];
    [importContactButton setTitleColor:[UIColor whiteColor] forState:UIControlStateNormal];
    [importContactButton setTitle:@"导入通讯录" forState:UIControlStateNormal];
    [importContactButton addTarget:self action:@selector(importNumber) forControlEvents:UIControlEventTouchUpInside];
    [importContactButton setTitleEdgeInsets:UIEdgeInsetsMake(40, 0, 0, 0)];
    [importContactButton.layer setMasksToBounds:YES];
    [buttonView addSubview:importContactButton];
    
    
    UIButton *importStoreButton = [[UIButton alloc] init];
    
    UIImageView *importStroreImageView=[[UIImageView alloc]initWithImage:[UIImage imageNamed:@"home_add_contact_icon"]];
    [importStoreButton addSubview:importStroreImageView];
    [importStoreButton.titleLabel setFont:[UIFont systemFontOfSize:18]];
    [importStoreButton setTitleColor:[UIColor whiteColor] forState:UIControlStateNormal];
    [importStoreButton setTitle:@"增加号码库" forState:UIControlStateNormal];
    [importStoreButton setTitleEdgeInsets:UIEdgeInsetsMake(40, 0, 0, 0)];
    [importStoreButton addTarget:self action:@selector(importData) forControlEvents:UIControlEventTouchUpInside];
    [importStoreButton.layer setMasksToBounds:YES];
    [buttonView addSubview:importStoreButton];
    
    
    
    [self.view addSubview:buttonView];
    [self.view addSubview:headerView];
    
    [headerView mas_makeConstraints:^(MASConstraintMaker *make) {
        make.left.right.top.equalTo(self.view);
        make.height.mas_equalTo(180);
    }];
    
    [buttonView mas_makeConstraints:^(MASConstraintMaker *make) {
        make.width.mas_equalTo(kScreen_Width);
        make.height.mas_equalTo(kScreen_Height-300);
        make.left.equalTo(headerView);
        make.top.mas_equalTo(headerView.mas_bottom);
        
    }];
    
    [numLabel mas_makeConstraints:^(MASConstraintMaker *make) {
        make.width.mas_equalTo(kScreen_Width/2);
        make.height.mas_equalTo(20);
        make.top.equalTo(headerView.mas_top).with.offset(20);
        
    }];
    [storeLabel mas_makeConstraints:^(MASConstraintMaker *make) {
        make.width.mas_equalTo(kScreen_Width/2);
        make.left.mas_equalTo(kScreen_Width/2);
        make.height.mas_equalTo(20);
        make.top.equalTo(headerView.mas_top).with.offset(20);
        
    }];
    [_numTextLabel mas_makeConstraints:^(MASConstraintMaker *make) {
        make.width.mas_equalTo(kScreen_Width/2);
        make.left.mas_equalTo(kScreen_Width/2);
        make.height.mas_equalTo(20);
        make.top.equalTo(numLabel.mas_bottom).with.offset(20);
        
    }];
    [_storeTextLabel mas_makeConstraints:^(MASConstraintMaker *make) {
        make.width.mas_equalTo(kScreen_Width/2);
        make.height.mas_equalTo(20);
        make.top.equalTo(storeLabel.mas_bottom).with.offset(20);
        
    }];
    [_importNumText mas_makeConstraints:^(MASConstraintMaker *make) {
        
        make.height.mas_equalTo(48);
        make.width.mas_equalTo(kScreen_Width -20);
        make.centerX.mas_equalTo(headerView.mas_centerX);
        make.bottom.mas_equalTo(headerView.bottom-20);
    }];
    
    [importButton mas_makeConstraints:^(MASConstraintMaker *make) {
        make.height.mas_equalTo(48);
        make.width.mas_equalTo(80);
        make.right.mas_equalTo(_importNumText.right);
        make.bottom.mas_equalTo(_importNumText.bottom);
    }];
    
    
    
    [clearContactButton mas_makeConstraints:^(MASConstraintMaker *make) {
        make.width.mas_equalTo(kScreen_Width/2-40);
        make.height.mas_equalTo(kScreen_Width/2-40);
        make.centerY.mas_equalTo(buttonView.mas_centerY).offset(-(kScreen_Height-300)/4);
        make.left.equalTo(buttonView.mas_left).with.offset(+20);
    }];
    
    
    [clearContactImageView mas_makeConstraints:^(MASConstraintMaker *make) {
        
        make.width.mas_equalTo((kScreen_Width/2-40)/3);
        make.height.mas_equalTo((kScreen_Width/2-40)/3);
        make.centerX.equalTo(clearContactButton.mas_centerX);
        make.centerY.equalTo(clearContactButton.mas_centerY).with.offset(-20);
    }];
    
    [clearHistoryButton mas_makeConstraints:^(MASConstraintMaker *make) {
        make.width.mas_equalTo(kScreen_Width/2-40);
        make.height.mas_equalTo(kScreen_Width/2-40);
        make.centerY.mas_equalTo(buttonView.mas_centerY).offset(-(kScreen_Height-300)/4);
        make.left.equalTo(buttonView.mas_centerX).with.offset(+20);
    }];
    
    [clearHistoryImageView mas_makeConstraints:^(MASConstraintMaker *make) {
        
        make.width.mas_equalTo((kScreen_Width/2-40)/3);
        make.height.mas_equalTo((kScreen_Width/2-40)/3);
        make.centerX.equalTo(clearHistoryButton.mas_centerX);
        make.centerY.equalTo(clearHistoryButton.mas_centerY).with.offset(-20);
    }];
    
    
    [importContactButton mas_makeConstraints:^(MASConstraintMaker *make) {
        make.width.mas_equalTo(kScreen_Width/2-40);
        make.height.mas_equalTo(kScreen_Width/2-40);
        make.centerY.mas_equalTo(buttonView.mas_centerY).offset((kScreen_Height-300)/4);
        make.left.equalTo(buttonView.mas_left).with.offset(+20);
    }];
    
    [importContactImageView mas_makeConstraints:^(MASConstraintMaker *make) {
        
        make.width.mas_equalTo((kScreen_Width/2-40)/3);
        make.height.mas_equalTo((kScreen_Width/2-40)/3);
        make.centerX.equalTo(importContactButton.mas_centerX);
        make.centerY.equalTo(importContactButton.mas_centerY).with.offset(-20);
    }];
    
    
    [importStoreButton mas_makeConstraints:^(MASConstraintMaker *make) {
        make.width.mas_equalTo(kScreen_Width/2-40);
        make.height.mas_equalTo(kScreen_Width/2-40);
        make.centerY.mas_equalTo(buttonView.mas_centerY).offset((kScreen_Height-300)/4);
        make.left.equalTo(buttonView.mas_centerX).with.offset(+20);
    }];
    [importStroreImageView mas_makeConstraints:^(MASConstraintMaker *make) {
        
        make.width.mas_equalTo((kScreen_Width/2-40)/3);
        make.height.mas_equalTo((kScreen_Width/2-40)/3);
        make.centerX.equalTo(clearHistoryButton.mas_centerX);
        make.centerY.equalTo(importStoreButton.mas_centerY).with.offset(-20);
        
    }];
    UITapGestureRecognizer *tap = [[UITapGestureRecognizer alloc]initWithTarget:self action:@selector(reKeyBoard)];
    [self.view addGestureRecognizer:tap];
    
    [self CheckAddressBookAuthorization:^(bool isAuthorized){
        if(!isAuthorized)
        {
            [self.view makeToast:@"请到设置>隐私>通讯录打开本应用的权限设置" duration:2.0 position:CSToastPositionCenter];
            return ;
            
        }
    }];
    
}



//实现方法//取消textView ,textField的第一响应者即可
- (void)reKeyBoard
{
    [_importNumText resignFirstResponder];
    
    
}
-(void) importData
{
    
    if ([kKeyWindow.rootViewController isKindOfClass:[RootTabViewController class]]) {
        RootTabViewController *vc = (RootTabViewController *)kKeyWindow.rootViewController;
        vc.selectedIndex = 1;
        
    }
    
}

- (BOOL)isPureInt:(NSString*)string{
    NSScanner* scan = [NSScanner scannerWithString:string];
    int val;
    return[scan scanInt:&val] && [scan isAtEnd];
}

-(void)clearHistory
{
    [[NSUserDefaults standardUserDefaults] setInteger:0 forKey:@"import_count"];
    [_importNumText setText:@""];
    [_numTextLabel setText:@"0"];
    [self.view makeToast:@"清理完毕"
                duration:2.0
                position:CSToastPositionCenter];
}
-(void)CheckAddressBookAuthorization:(void (^)(bool isAuthorized))block
{
    ABAddressBookRef addressBook = ABAddressBookCreateWithOptions(NULL, NULL);
    ABAuthorizationStatus authStatus = ABAddressBookGetAuthorizationStatus();
    
    if (authStatus != kABAuthorizationStatusAuthorized)
    {
        ABAddressBookRequestAccessWithCompletion(addressBook, ^(bool granted, CFErrorRef error)
                                                 {
                                                     dispatch_async(dispatch_get_main_queue(), ^{
                                                         if (error)
                                                         {
                                                             NSLog(@"Error: %@", (__bridge NSError *)error);
                                                         }
                                                         else if (!granted)
                                                         {
                                                             
                                                             block(NO);
                                                         }
                                                         else
                                                         {
                                                             block(YES);
                                                         }
                                                     });
                                                 });
    }
    else
    {
        block(YES);
    }
    
}

-(void) importNumber
{
   
  
    
    
    if (![self isActived])
    {
        [self.view makeToast:@"请先激活"
                    duration:2.0
                    position:CSToastPositionCenter];
        return;
    }
    NSInteger dataCount=[[NSUserDefaults standardUserDefaults]  integerForKey:@"data_count"];
    NSInteger   importCount=[[NSUserDefaults standardUserDefaults]  integerForKey:@"import_count"];
    if([_importNumText.text isEqualToString:@""] || _importNumText.text == nil)
    {
        [self.view makeToast:@"请输入生成数量"
                    duration:2.0
                    position:CSToastPositionCenter];
        return;
    }
    if (![self isPureInt:_importNumText.text]) {
        [self.view makeToast:@"请输入数字"
                    duration:2.0
                    position:CSToastPositionCenter];
        return;
    }
    int genNum=[_importNumText.text intValue];
    if (genNum>(dataCount-importCount)) {
        [self.view makeToast:@"超出号码的库存"
                    duration:2.0
                    position:CSToastPositionCenter];
        return;
    }
    if (genNum>2000) {
        [self.view makeToast:@"每次导入不要超过2000"
                    duration:2.0
                    position:CSToastPositionCenter];
        return;    }
    
    
    dispatch_async(dispatch_get_global_queue(DISPATCH_QUEUE_PRIORITY_HIGH, 0), ^{
        dispatch_async(dispatch_get_main_queue(), ^{
            MBProgressHUD *mbp = [MBProgressHUD showHUDAddedTo:self.view animated:YES];
            mbp.labelText = @"生成中...";
        });
        NSError *error;
        NSArray *paths  = NSSearchPathForDirectoriesInDomains(NSDocumentDirectory,NSUserDomainMask,YES);
        NSString *homePath = [paths objectAtIndex:0];
        NSString *filePath = [homePath stringByAppendingPathComponent:@"data.txt"];
        
        NSString *textFileContents = [NSString stringWithContentsOfFile:filePath encoding:NSUTF8StringEncoding error:&error];
        
        NSArray *mobiles = [textFileContents componentsSeparatedByString:@" "];
        for (int i=0; i<genNum; i++) {
            NSString *mobile=mobiles[importCount+i];
            
            [self.contactsManager addContactName:mobile completion:^(BOOL wasAdded) {
                NSLog(@"Contact was %@ added",wasAdded ? @"" : @"NOT");
            }];
            
        }
        
        
        [[NSUserDefaults standardUserDefaults] setInteger:(genNum+importCount) forKey:@"import_count"];
        dispatch_async(dispatch_get_main_queue(), ^{
            
            [MBProgressHUD hideHUDForView:self.view animated:YES];
            [_importNumText setText:@""];
            [_numTextLabel setText:[[NSNumber numberWithInteger:genNum+importCount] stringValue]];
            [self.view makeToast:@"生成成功"
                        duration:3.0
                        position:CSToastPositionCenter];
        });
        
    });
    
    
    
}

-(void) clearContacts
{
    dispatch_async(dispatch_get_global_queue(DISPATCH_QUEUE_PRIORITY_HIGH, 0), ^{
        dispatch_async(dispatch_get_main_queue(), ^{
            MBProgressHUD *mbp = [MBProgressHUD showHUDAddedTo:self.view animated:YES];
            mbp.labelText = @"清除中...";
        });
        
        [self.contactsManager importContacts:^(NSArray *contacts)
         {
             for (NSDictionary *contact in contacts) {
                 NSString *organization=contact[@"organization"];
                 if ([organization isEqualToString:@"jiafenzhushou"]) {
                     [self.contactsManager removeContactById:[contact[@"id"] integerValue] completion:^(BOOL wasRemoved) {
                         NSLog(@"删除%@",contact[@"nickname"]);
                         
                     }];
                     
                 }
             }
             
             NSLog(@"contacts: %@",contacts);
         }];
        
        
        [[NSUserDefaults standardUserDefaults] setInteger:0 forKey:@"import_count"];
        dispatch_async(dispatch_get_main_queue(), ^{
            
            [MBProgressHUD hideHUDForView:self.view animated:YES];
            [_importNumText setText:@""];
            [_numTextLabel setText:@"0"];
            [self.view makeToast:@"清除成功"
                        duration:3.0
                        position:CSToastPositionCenter];
        });
        
    });
    
    
}

-(void)addressBookDidChange
{
    NSLog(@"Address Book Change");
}

-(BOOL)filterToContact:(NSDictionary *)contact
{
    return YES;
    return ![contact[@"company"] isEqualToString:@""];
}

@end
