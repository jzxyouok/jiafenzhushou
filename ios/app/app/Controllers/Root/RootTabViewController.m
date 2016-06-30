//
//  RootTabViewController.m
//  app
//
//  Created by Rocks on 16/4/21.
//  Copyright © 2016年 jiafenzhushou. All rights reserved.
//

#import "RootTabViewController.h"
#import "SettingViewController.h"
#import "HomeViewController.h"
#import "StoreViewController.h"
#import "RDVTabBarItem.h"
#import "BaseNavigationController.h"

@interface RootTabViewController ()

@end

@implementation RootTabViewController

- (id)initWithNibName:(NSString *)nibNameOrNil bundle:(NSBundle *)nibBundleOrNil
{
    self = [super initWithNibName:nibNameOrNil bundle:nibBundleOrNil];
    if (self) {
        // Custom initialization
    }
    return self;
}

- (void)viewDidLoad
{
    [super viewDidLoad];
    // Do any additional setup after loading the view.
    [self setupViewControllers];
}

- (void)didReceiveMemoryWarning
{
    [super didReceiveMemoryWarning];
    // Dispose of any resources that can be recreated.
}
/*
#pragma mark - Navigation

// In a storyboard-based application, you will often want to do a little preparation before navigation
- (void)prepareForSegue:(UIStoryboardSegue *)segue sender:(id)sender {
    // Get the new view controller using [segue destinationViewController].
    // Pass the selected object to the new view controller.
}
*/

#pragma mark Private_M
- (void)setupViewControllers {
    HomeViewController *home=[[HomeViewController alloc]init];
    UINavigationController *nav_home = [[BaseNavigationController alloc] initWithRootViewController:home];
    StoreViewController *store=[[StoreViewController alloc]init];
     UINavigationController *nav_store = [[BaseNavigationController alloc] initWithRootViewController:store];
    SettingViewController *setting=[[SettingViewController alloc]init];
         UINavigationController *nav_setting = [[BaseNavigationController alloc] initWithRootViewController:setting];
    [self setViewControllers:@[nav_home, nav_store, nav_setting]];
    [self customizeTabBarForController];
    self.delegate = self;
}

- (void)customizeTabBarForController {

    //UIImage *backgroundImage = [UIImage imageNamed:@"tabbar_background"];
    NSArray *tabBarItemImages = @[@"tab_item_home", @"tab_item_store", @"tab_item_setting"];
     NSArray *tabBarItemTitles = @[@"首页", @"号码库", @"设置"];
    NSInteger index = 0;
    CGRect tabBarRect=[self tabBar].bounds;
    CGRect rect=CGRectMake(tabBarRect.origin.x, tabBarRect.origin.y+18, tabBarRect.size.width, tabBarRect.size.height-18);
    UIImageView *bgImgView = [[UIImageView alloc] initWithFrame:rect];
    [bgImgView setImage:[UIImage imageNamed:@"tab_bottom_bg"]];
    [self.tabBar addSubview:bgImgView];
    [self.tabBar sendSubviewToBack:bgImgView];
 
   
    for (RDVTabBarItem *item in [[self tabBar] items]) {
        item.titlePositionAdjustment = UIOffsetMake(0, 3);
        
        UIImage *selectedimage = [UIImage imageNamed:[NSString stringWithFormat:@"%@_selected",
                                                      [tabBarItemImages objectAtIndex:index]]];
        UIImage *unselectedimage = [UIImage imageNamed:[NSString stringWithFormat:@"%@_unselected",
                                                        [tabBarItemImages objectAtIndex:index]]];
        [item setFinishedSelectedImage:selectedimage withFinishedUnselectedImage:unselectedimage];
        [item setBackgroundSelectedImage:[UIImage imageNamed:@"tab_item_selected_bg"] withUnselectedImage:[UIImage imageWithColor:[UIColor clearColor]]];
        [item setTitle:[tabBarItemTitles objectAtIndex:index]];
        index++;
    }
  
}
#pragma mark RDVTabBarControllerDelegate
- (BOOL)tabBarController:(RDVTabBarController *)tabBarController shouldSelectViewController:(UIViewController *)viewController{
    if (tabBarController.selectedViewController != viewController) {
        return YES;
    }
    if (![viewController isKindOfClass:[UINavigationController class]]) {
        return YES;
    }
    UINavigationController *nav = (UINavigationController *)viewController;
    if (nav.topViewController != nav.viewControllers[0]) {
        return YES;
    }
   
 
    return YES;
}
@end
 
