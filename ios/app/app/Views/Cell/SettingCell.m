//
//  SettingCell.m
//  app
//
//  Created by Rocks on 16/5/20.
//  Copyright © 2016年 jiafenzhushou. All rights reserved.
//

#import "SettingCell.h"

@interface SettingCell ()
@property (strong, nonatomic) UILabel *titleLabel;
@property (strong, nonatomic) UIImageView *titleImageView;
@property (strong, nonatomic) NSString *title;
@end

@implementation SettingCell

- (id)initWithStyle:(UITableViewCellStyle)style reuseIdentifier:(NSString *)reuseIdentifier
{
    self = [super initWithStyle:style reuseIdentifier:reuseIdentifier];
    if (self) {
        // Initialization code
        self.accessoryType = UITableViewCellAccessoryDisclosureIndicator;
        self.backgroundColor = kColorTableBG;
        if (!_titleLabel) {
            _titleLabel = [[UILabel alloc] initWithFrame:CGRectMake(kPaddingLeftWidth, 0, (kScreen_Width - 120), 60)];
            _titleLabel.backgroundColor = [UIColor clearColor];
            _titleLabel.font = [UIFont systemFontOfSize:16];
            _titleLabel.textColor = [UIColor blackColor];
            [self.contentView addSubview:_titleLabel];
        }
    }
    return self;
}

- (void)layoutSubviews{
    [super layoutSubviews];
    _titleLabel.text = _title;
}

- (void)setTitleStr:(NSString *)title{
    self.title = title;
}
-(void) setTitleImage:(NSString *)title
{
    
}
@end
