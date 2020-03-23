//
//  ViewController.swift
//  Cap6
//
//  Created by Alberto.
//  Copyright © 201 Alberto. All rights reserved.
//

import UIKit

class ViewController: UIViewController {

   
    @IBOutlet weak var nameLabel: UILabel!
    
    @IBAction func showName(sender: AnyObject) {
        
        nameLabel.text = "My Name is Brad!"
        
    }
    
    
    override func viewDidLoad() {
        super.viewDidLoad()
        // Do any additional setup after loading the view, typically from a nib.
    }

    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
        // Dispose of any resources that can be recreated.
    }


}

