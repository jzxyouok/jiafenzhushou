//
//  VCityCell.h
//  app
//
//  Created by Rocks on 16/5/16.
//  Copyright © 2016年 jiafenzhushou. All rights reserved.
//

#import <UIKit/UIKit.h>

@interface VCityCell : UICollectionViewCell
@property (strong, nonatomic) NSString *city;
@property (assign, nonatomic) BOOL hasBeenSelected;

+ (CGSize)ccellSizeWithObj:(id)obj;
@end
