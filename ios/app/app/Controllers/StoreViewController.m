//
//  StoreViewController.m
//  app
//
//  Created by Rocks on 16/4/24.
//  Copyright © 2016年 jiafenzhushou. All rights reserved.
//
#define kCCellIdentifier_Tag @"CityCell"
#import "StoreViewController.h"
#import "VCityCell.h"
#import "YMCitySelect.h"
#import "MBProgressHUD.h"
 

@interface StoreViewController() <UICollectionViewDelegate, UICollectionViewDataSource,UIGestureRecognizerDelegate>
@property (nonatomic, strong) UICollectionView* gridView;
@property (nonatomic, strong) UITextField* choseCityText;
@property (nonatomic,assign)  int number;
@property (nonatomic,strong)  UITextField *genNumText;


@end

@implementation StoreViewController

- (void)viewDidLoad {
    [super viewDidLoad];
    // Do any additional setup after loading the view from its nib.
    self.title=@"加粉助手";
    _cities=[NSMutableArray array];
    [self initView];
    
    
}

- (void)didReceiveMemoryWarning {
    [super didReceiveMemoryWarning];
    
}
#pragma mark - HeaderView
-(void) initView
{
    UIView *headerView=[UIView new];
    UIView *listView=[UIView new];
    [self.view setBackgroundColor:[UIColor colorWithHexString:@"0xffffff"]];
    headerView.backgroundColor=kNavBackground;

    UIImageView *titleImageView=[[UIImageView alloc]initWithImage:[UIImage imageNamed:@"store_title_logo"]];
    self.navigationItem.titleView=titleImageView;
    
    _choseCityText=[[UITextField alloc]init];
    _choseCityText.font = [UIFont boldSystemFontOfSize:20];
    _choseCityText.textColor = [UIColor colorWithHexString:@"0xffffff"];
    _choseCityText.textAlignment = NSTextAlignmentLeft;
    _choseCityText.placeholder=@"请选择城市";
    _choseCityText.backgroundColor=[UIColor colorWithHexString:@"0xffffff"];
    [_choseCityText addTarget:self action:@selector(choseCity) forControlEvents:UIControlEventAllTouchEvents];
    
 
    UIImageView *cityLeftview=[[UIImageView alloc]initWithImage:[UIImage imageNamed:@"store_city_icon"]];
    _choseCityText.leftViewMode = UITextFieldViewModeAlways;
    _choseCityText.leftView = cityLeftview;
    [_choseCityText setTextColor:[UIColor blackColor]];
    [_choseCityText.layer setCornerRadius:4];
    [headerView addSubview:_choseCityText];
  
    UIButton *choseCityButton = [[UIButton alloc] init];
    [choseCityButton.titleLabel setFont:[UIFont systemFontOfSize:18]];
    [choseCityButton setTitleColor:[UIColor whiteColor] forState:UIControlStateNormal];
    [choseCityButton setTitleColor:[UIColor colorWithWhite:1.0 alpha:0.5] forState:UIControlStateHighlighted];
    [choseCityButton setTitle:@"选择" forState:UIControlStateNormal];
    [choseCityButton setBackgroundImage:[UIImage imageWithColor:[UIColor colorWithHexString:@"0xd35400"]] forState:UIControlStateNormal];
    [choseCityButton.layer setMasksToBounds:YES];
    [choseCityButton addTarget:self action:@selector(choseCity) forControlEvents:UIControlEventTouchUpInside];
    
    [_choseCityText addSubview:choseCityButton];
    
    
     _genNumText=[[UITextField alloc]init];
    _genNumText.font = [UIFont boldSystemFontOfSize:20];
    _genNumText.textColor = [UIColor colorWithHexString:@"0xffffff"];
    _genNumText.textAlignment = NSTextAlignmentLeft;
    _genNumText.placeholder=@"数量不超过10000";
    _genNumText.backgroundColor=[UIColor colorWithHexString:@"0xffffff"];
    
    
    UIImageView *numLeftview=[[UIImageView alloc]initWithImage:[UIImage imageNamed:@"store_gen_icon"]];
    _genNumText.leftViewMode = UITextFieldViewModeAlways;
    _genNumText.leftView = numLeftview;
    _genNumText.keyboardType = UIKeyboardTypeNumberPad;
    [_genNumText setTextColor:[UIColor blackColor]];
    [_genNumText.layer setCornerRadius:4];
    
    [headerView addSubview:_genNumText];
    
    UIButton *initNumButton = [[UIButton alloc] init];
    [initNumButton.titleLabel setFont:[UIFont systemFontOfSize:18]];
    [initNumButton setTitleColor:[UIColor whiteColor] forState:UIControlStateNormal];
    [initNumButton setTitleColor:[UIColor colorWithWhite:1.0 alpha:0.5] forState:UIControlStateHighlighted];
    [initNumButton setTitle:@"生成" forState:UIControlStateNormal];
    [initNumButton setBackgroundImage:[UIImage imageWithColor:[UIColor colorWithHexString:@"0xd35400"]] forState:UIControlStateNormal];
    [initNumButton.layer setMasksToBounds:YES];
    [initNumButton addTarget:self action:@selector(genNumber) forControlEvents:UIControlEventTouchUpInside];
    [_genNumText addSubview:initNumButton];
    
    //list
    UIView *lineView=[[UIView alloc]init];
    [lineView setBackgroundColor:kNavBackground];
    [listView addSubview:lineView];
    
    UIView *vlineView=[[UIView alloc]init];
    [vlineView setBackgroundColor:[UIColor colorWithHexString:@"0xcacaca"]];
    [listView addSubview:vlineView];
    
    UILabel *choseLabel=[[UILabel alloc]init];
    choseLabel.text=@"热门城市";
    [choseLabel setFont:[UIFont systemFontOfSize:18]];
    [listView addSubview:choseLabel];
    
    UIButton *moreLabel=[[UIButton alloc]init];
    [moreLabel setTitle:@"更多城市" forState:UIControlStateNormal];
    [moreLabel.titleLabel setFont:[UIFont systemFontOfSize:18]];
    [moreLabel setTitleColor:[UIColor colorWithHexString:@"0x000000"] forState:UIControlStateNormal];
    [moreLabel addTarget:self action:@selector(choseCity) forControlEvents:UIControlEventTouchUpInside];
    [listView addSubview:moreLabel];
    
    UICollectionViewFlowLayout *layout = [[UICollectionViewFlowLayout alloc] init];
    _gridView = [[UICollectionView alloc] initWithFrame:listView.bounds collectionViewLayout:layout];
    [_gridView setBackgroundColor:[UIColor clearColor]];
    [_gridView registerClass:[VCityCell class] forCellWithReuseIdentifier:kCCellIdentifier_Tag];
    _gridView.dataSource = self;
    _gridView.delegate = self;
    [listView addSubview:_gridView];
 
    
 
    
    [self.view addSubview:listView];
    [self.view addSubview:headerView];
    
    [headerView mas_makeConstraints:^(MASConstraintMaker *make) {
        make.left.right.top.equalTo(self.view);
        make.height.mas_equalTo(180);
    }];
    
    [listView mas_makeConstraints:^(MASConstraintMaker *make) {
        make.width.mas_equalTo(kScreen_Width-16);
        make.height.mas_equalTo(kScreen_Height-224);
        make.left.equalTo(headerView).with.offset(8);
        make.top.mas_equalTo(headerView.mas_bottom).with.offset(14);
    }];
    
    
    [_choseCityText mas_makeConstraints:^(MASConstraintMaker *make) {
        
        make.height.mas_equalTo(48);
        make.width.mas_equalTo(kScreen_Width -20);
        make.centerX.mas_equalTo(headerView.mas_centerX);
        make.top.equalTo(headerView.mas_top).with.offset(20);
    }];
    
    [choseCityButton mas_makeConstraints:^(MASConstraintMaker *make) {
        make.height.mas_equalTo(48);
        make.width.mas_equalTo(80);
        make.right.mas_equalTo(_choseCityText.right);
        make.bottom.mas_equalTo(_choseCityText.bottom);
    }];
    
    [_genNumText mas_makeConstraints:^(MASConstraintMaker *make) {
        
        make.height.mas_equalTo(48);
        make.width.mas_equalTo(kScreen_Width -20);
        make.centerX.mas_equalTo(headerView.mas_centerX);
        make.top.equalTo(_choseCityText.mas_bottom).with.offset(30);
    }];
    
    [initNumButton mas_makeConstraints:^(MASConstraintMaker *make) {
        make.height.mas_equalTo(48);
        make.width.mas_equalTo(80);
        make.right.mas_equalTo(_genNumText.right);
        make.bottom.mas_equalTo(_genNumText.bottom);
    }];
    
    [vlineView mas_makeConstraints:^(MASConstraintMaker *make) {
        make.width.mas_equalTo(kScreen_Width-16);
        make.height.mas_equalTo(@0.5);
        make.left.mas_equalTo(listView.left);
        make.top.mas_equalTo(listView.top).with.offset(28);
    }];
    
    [lineView mas_makeConstraints:^(MASConstraintMaker *make) {
        make.height.mas_equalTo(20);
        make.width.mas_equalTo(2);
        make.left.mas_equalTo(listView.left);
        make.top.mas_equalTo(listView.top);
    }];
    
    [choseLabel mas_makeConstraints:^(MASConstraintMaker *make) {
       
        make.left.mas_equalTo(listView.left).with.offset(8);
        make.top.mas_equalTo(listView.top);
    }];
    
    [moreLabel mas_makeConstraints:^(MASConstraintMaker *make) {
        make.height.mas_equalTo(20);
        make.right.mas_equalTo(listView.right).with.offset(-8);
        make.top.mas_equalTo(listView.top);
    }];
    
    [_gridView mas_makeConstraints:^(MASConstraintMaker *make) {
        
        make.height.mas_equalTo(listView.mas_height).offset(-136);
        make.width.mas_equalTo(kScreen_Width);
        make.top.mas_equalTo(listView.mas_top).offset(30);
    }];
    UITapGestureRecognizer *tap = [[UITapGestureRecognizer alloc]initWithTarget:self action:@selector(reKeyBoard)];
    tap.delegate=self;
    [self.view addGestureRecognizer:tap];
    [self initHot];
    
    

    
}

-(BOOL)gestureRecognizer:(UIGestureRecognizer *)gestureRecognizer shouldReceiveTouch:(UITouch *)touch
{
     
    if (touch.view !=_genNumText&&touch.view != _gridView) {//如果当前是tableView
        [_choseCityText resignFirstResponder];
        [_genNumText resignFirstResponder];
        return NO;
    }
    
    return YES;
    
}


//实现方法//取消textView ,textField的第一响应者即可
- (void)reKeyBoard
{
    [_choseCityText resignFirstResponder];
    [_genNumText resignFirstResponder];
 
    
    
}

-(void)choseCity
{
    if (![self isActived])
    {
        [self.view makeToast:@"请先激活"
                    duration:2.0
                    position:CSToastPositionCenter];
        return;
    }
  [self presentViewController:[[YMCitySelect alloc] initWithDelegate:self] animated:YES completion:nil];
}

-(void)ym_ymCitySelectCityName:(NSString *)cityName{
    if (![self isActived])
    {
        [self.view makeToast:@"请先激活"
                    duration:2.0
                    position:CSToastPositionCenter];
        return;
    }
    _selectedCity = cityName;
     [_choseCityText setText:_selectedCity];
     [self.gridView reloadData];
}


#pragma hot city init
-(void) initHot
{
        @weakify(self);
        dispatch_async(dispatch_get_global_queue(DISPATCH_QUEUE_PRIORITY_DEFAULT, 0), ^{
            
            NSString *hotPath = [[NSBundle mainBundle] pathForResource:@"hot" ofType:@"txt"];
            _cities= [self readFile:hotPath];
            dispatch_async(dispatch_get_main_queue(), ^{
                @strongify(self);
                [self.gridView reloadData];
                
            });
        });
  
}

- (BOOL)isPureInt:(NSString*)string{
    NSScanner* scan = [NSScanner scannerWithString:string];
    int val;
    return[scan scanInt:&val] && [scan isAtEnd];
}

-(void)genNumber
{
    if (![self isActived])
    {
        [self.view makeToast:@"请先激活"
                    duration:2.0
                    position:CSToastPositionCenter];
        return;
    }
    
    if (!_selectedCity) {
        
        [self.view makeToast:@"请选择城市"
                    duration:2.0
                    position:CSToastPositionCenter];
        return;
    }
    if([_genNumText.text isEqualToString:@""] || _genNumText.text == nil)
    {
        [self.view makeToast:@"请输入生成数量"
                    duration:2.0
                    position:CSToastPositionCenter];
        return;
    }
    if (![self isPureInt:_genNumText.text]) {
        [self.view makeToast:@"请输入数字"
                    duration:2.0
                    position:CSToastPositionCenter];
        return;
    }
    _number=[_genNumText.text intValue];
    

    if (_number==0) {
        [self.view makeToast:@"请输入生成量"
                    duration:2.0
                    position:CSToastPositionCenter];
        return;
    }
    if (_number>10000) {
        [self.view makeToast:@"生成量小于10000"
                    duration:2.0
                    position:CSToastPositionCenter];
        return;
    }
    

    
 
    dispatch_async(dispatch_get_global_queue(DISPATCH_QUEUE_PRIORITY_HIGH, 0), ^{
        dispatch_async(dispatch_get_main_queue(), ^{
            MBProgressHUD *mbp = [MBProgressHUD showHUDAddedTo:self.view animated:YES];
            mbp.labelText = @"生成中...";
        });
 
        NSError *error;
        NSString *textFileContents = [NSString stringWithContentsOfFile:[[NSBundle mainBundle] pathForResource:_selectedCity ofType:@"txt"]encoding:NSUTF8StringEncoding error: & error];
        NSArray *mobiles = [textFileContents componentsSeparatedByString:@" "];
        
        NSString *mobileText=@"";
        
        for (int i=0; i<_number; i++) {
            int num = (arc4random() % 10000);
            NSString *mobielEnd = [NSString stringWithFormat:@"%.4d", num];
            int prePos = arc4random() % mobiles.count;
            NSString *mobilePre=mobiles[prePos];
            NSString *mobile=[NSString stringWithFormat:@"%@%@ ",mobilePre,mobielEnd];
            mobileText= [mobileText stringByAppendingString:mobile];
          
        }
      
        
        NSArray *paths  = NSSearchPathForDirectoriesInDomains(NSDocumentDirectory,NSUserDomainMask,YES);
        NSString *homePath = [paths objectAtIndex:0];
        NSString *filePath = [homePath stringByAppendingPathComponent:@"data.txt"];
        [mobileText writeToFile:filePath atomically:YES encoding:NSUTF8StringEncoding error:nil];
        
        [[NSUserDefaults standardUserDefaults] setInteger:_number forKey:@"data_count"];
        [[NSUserDefaults standardUserDefaults] setInteger:0 forKey:@"import_count"];
        dispatch_async(dispatch_get_main_queue(), ^{
         
            [MBProgressHUD hideHUDForView:self.view animated:YES];
            _selectedIndex=nil;
            _selectedCity=nil;
            [_choseCityText setText:@""];
            [_genNumText setText:@""];
            [_gridView reloadData];
            [self.view makeToast:@"生成成功"
                        duration:3.0
                        position:CSToastPositionCenter];
        });  
        
    });
 

}


- (NSArray *) readFile:(NSString *) path {
    NSString *file = [NSString stringWithContentsOfFile:path encoding:NSUTF8StringEncoding error:nil];
    
    NSMutableArray *dict = [[NSMutableArray alloc] init];
    NSCharacterSet *cs = [NSCharacterSet newlineCharacterSet];
    NSScanner *scanner = [NSScanner scannerWithString:file];
    
    NSString *line;
    while(![scanner isAtEnd]) {
        if([scanner scanUpToCharactersFromSet:cs intoString:&line]) {
            NSString *copy = [NSString stringWithString:line];
            [dict addObject:copy];
            
        }
    }
    NSArray *newArray = [[NSArray alloc] initWithArray:dict];

    return newArray;
}

- (NSInteger)collectionView:(UICollectionView *)collectionView numberOfItemsInSection:(NSInteger)section
{
  
    return _cities.count;
}

// The cell that is returned must be retrieved from a call to -dequeueReusableCellWithReuseIdentifier:forIndexPath:
- (UICollectionViewCell *)collectionView:(UICollectionView *)collectionView cellForItemAtIndexPath:(NSIndexPath *)indexPath
{
    VCityCell *cell = [collectionView dequeueReusableCellWithReuseIdentifier:kCCellIdentifier_Tag forIndexPath:indexPath];
    NSString *city = [_cities objectAtIndex:indexPath.row];
    cell.city=city;
    cell.hasBeenSelected = [_selectedCity isEqualToString:city];
    return cell;
}

- (CGSize)collectionView:(UICollectionView *)collectionView layout:(UICollectionViewLayout*)collectionViewLayout sizeForItemAtIndexPath:(NSIndexPath *)indexPath{
    return [VCityCell ccellSizeWithObj:[_cities objectAtIndex:indexPath.row]];
}

- (UIEdgeInsets)collectionView:(UICollectionView *)collectionView layout:(UICollectionViewLayout*)collectionViewLayout insetForSectionAtIndex:(NSInteger)section{
    return UIEdgeInsetsMake(10, 10, 10, 10);
}
 
- (CGFloat)collectionView:(UICollectionView *)collectionView layout:(UICollectionViewLayout*)collectionViewLayout minimumLineSpacingForSectionAtIndex:(NSInteger)section{
    return 8;
}
- (CGFloat)collectionView:(UICollectionView *)collectionView layout:(UICollectionViewLayout*)collectionViewLayout minimumInteritemSpacingForSectionAtIndex:(NSInteger)section{
    return 5;
}
- (void)collectionView:(UICollectionView *)collectionView didSelectItemAtIndexPath:(NSIndexPath *)indexPath{
    NSString *city = [_cities objectAtIndex:indexPath.row];
    _selectedCity=city;
    [_choseCityText setText:city];
    if (_selectedIndex!=nil) {
        [collectionView reloadItemsAtIndexPaths:[NSArray arrayWithObject:_selectedIndex]];
    }
    [collectionView reloadItemsAtIndexPaths:[NSArray arrayWithObject:indexPath]];
    _selectedIndex=indexPath;
}



@end
