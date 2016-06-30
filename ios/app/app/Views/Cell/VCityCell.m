//
//  VCityCell.m
//  app
//
//  Created by Rocks on 16/5/16.
//  Copyright © 2016年 jiafenzhushou. All rights reserved.
//

#define kCityCell_Font [UIFont systemFontOfSize:16]
#define kCityCell_Height 40.0
#define kCityCell_Width ((kScreen_Width-36.0)/3)


#import "VCityCell.h"

@interface VCityCell()
@property (strong, nonatomic) UILabel *cityLabel;
@end

@implementation VCityCell

-(void) setCity:(NSString *)city
{
    _city=city;
    if (!_city) {
         return;
    }
    if (!_cityLabel) {
        self.contentView.layer.cornerRadius = 2.0;
        self.layer.cornerRadius = 2.0;
        _cityLabel = [[UILabel alloc] initWithFrame:CGRectMake(5, (kCityCell_Height-20)/2, kCityCell_Width, 20)];
        _cityLabel.font = kCityCell_Font;
        _cityLabel.textAlignment = NSTextAlignmentCenter;
        _cityLabel.minimumScaleFactor = 0.5;
        _cityLabel.adjustsFontSizeToFitWidth = YES;
        [self.contentView addSubview:_cityLabel];
    }
    _cityLabel.text =_city;
    [_cityLabel setCenter:self.contentView.center];
    
}
- (void)setHasBeenSelected:(BOOL)hasBeenSelected{
    _hasBeenSelected = hasBeenSelected;
    if (_hasBeenSelected) {
        self.backgroundColor = [UIColor colorWithHexString:@"0xFF6300"];
        _cityLabel.textColor = [UIColor whiteColor];
    }else{
        self.backgroundColor =  [UIColor colorWithHexString:@"0xf1f1f1"];;
        _cityLabel.textColor = [UIColor blackColor];
    }
}

+ (CGSize)ccellSizeWithObj:(id)obj{
    CGSize ccellSize = CGSizeZero;
    if ([obj isKindOfClass:[NSString class]]) {
    
        ccellSize = CGSizeMake(kCityCell_Width, kCityCell_Height);
    }
    return ccellSize;
}

@end
