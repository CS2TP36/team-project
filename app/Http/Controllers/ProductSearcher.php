<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ProductLister;
// A class to assist with searching for products with a keyword
class ProductSearcher extends Controller
{
    // Returns a list of products which meet the search term
    public function search(String $searchTerm = "", bool $mens = true): array
    {
        // gets all the products in an array
        $products = ProductLister::get($mens);
        // create a blank array
        $toReturn = [];
        // iterate through all the products to see if they meet the search criteria
        foreach($products as $product){
            // checks for both title and description
            if (($this->stringSearch($searchTerm, $product->name)) or ($this->stringSearch($searchTerm, $product->description))) {
                // adds it if match is found
                $toReturn[] = $product;
            }

        }
        // returns the final list
        return $toReturn;
    }
    // a very bad, inefficient and inaccurate searching algorithm
    function stringSearch(String $searchTerm, String $subject): bool
    {
        // convert both strings to arrays
        $subjectArr = explode(" ", $subject);
        $searchTermArr = explode(" ", $searchTerm);
        // check if there is any crossover in words between the two strings
        foreach($searchTermArr as $searchWord){
            foreach($subjectArr as $subjectWord){
                // perform the test in lowercase to remove any capitalisation error
                if(strtolower($searchWord) == strtolower($subjectWord)){
                    // return true if a common word found
                    return true;
                }
            }
        }
        // return false if nothing is found
        return false;

    }


}