//
//  ViewController.m
//  DubDub
//
//  Created by Aaron Wojnowski on 2013-03-31.
//  Copyright (c) 2013 Aaron Wojnowski. All rights reserved.
//

#import "ViewController.h"

@interface ViewController ()

@end

@implementation ViewController {
    
    UIWebView *_webView;
    
}

-(void)viewWillAppear:(BOOL)animated {
    
    [super viewWillAppear:animated];
    
    [self loadWWDCPage];
    
}

-(void)viewDidLoad {
    
    [super viewDidLoad];    
    
    UIWebView *webView = [[UIWebView alloc] init];
    [webView setFrame:[[self view] bounds]];
    [webView setScalesPageToFit:YES];
    [[self view] addSubview:webView];
    _webView = webView;
    
    [self loadWWDCPage];
    
}

#pragma mark - WebView

-(void)loadWWDCPage {
    
    [_webView loadRequest:[NSURLRequest requestWithURL:[NSURL URLWithString:@"http://developer.apple.com/wwdc"]]];
    
}

@end
