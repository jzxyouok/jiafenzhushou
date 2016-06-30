//
//  StoreViewController.h
//  app
//
//  Created by Rocks on 16/4/24.
//  Copyright © 2016年 jiafenzhushou. All rights reserved.
//

#import "BaseViewController.h"

@interface StoreViewController : BaseViewController

@property (strong, nonatomic) NSArray *cities;
@property (copy, nonatomic) NSString *selectedCity;
@property (copy, nonatomic) NSIndexPath *selectedIndex;
@end
