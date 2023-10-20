<?php

namespace App\Controllers;
// Import necessary classes
use CodeIgniter\Controller;
use CodeIgniter\Cache\CacheInterface;

class Report extends BaseController
{
     

    public function index()
    {
        $cache = \Config\Services::cache();

        $data['users'] = $cache->remember('cached_data', 3600, function () {
            $db = \Config\Database::connect();
            $query = $db->table('users')->get()->getResult();
            return $query;
        });

     
         
        return view('staff/cache_index', $data);
    }

    
    public function callotherfunction()
    {
        $this->bar();
    }

    public function delete_cache()
    {
        $cache = \Config\Services::cache(); // Load the Cache service
        $cache->delete('cached_data');

     
         
        return redirect()->to('/user-index');
    }

   

    public function bar()
    {
        $db = \Config\Database::connect();
        $data['query'] = $db->query('select state,count(*) as total from staffs
        group by state');
        return view('report/bar',$data);
    }

    public function line()
    {
        $db = \Config\Database::connect();
        $data['query'] = $query = $db->query("SELECT age,SUM(CASE WHEN gender='Male' THEN 1 ELSE 0 END ) AS male, 
        SUM(CASE WHEN gender='Female' THEN 1 ELSE 0 END ) AS female, COUNT( * ) AS TOTAL 
        FROM staffs 
        WHERE age <=50
        GROUP BY age");
        //dd($query);
        
        return view('report/line',$data);
    }

    public function pie()
    {
        $db = \Config\Database::connect();
        $data['query'] = $db->query('select gender,count(*) as total from staffs
        group by gender');
        return view('report/pie',$data);
    }

    public function cache_staff()
    {
         
        //$cache->clean();

        /*

        // Define a unique cache key for your query result
        $cacheKey = 'my_query_cache_key';

        // Check if the data is in the cache
        $cachedResult = $cache->get($cacheKey);

        if ($cachedResult === null) {
            // Data is not in cache, fetch it from the database
            $db = \Config\Database::connect();
            $query = $db->table('users')->get()->getResultArray();

            // Cache the query result for a specified time (e.g., 3600 seconds or 1 hour)
            $cache->save($cacheKey, $query, 3600);

            // Use the query result from the database
            $data['staffs'] = $query;
        } else {
            // Use the cached data
            $data['staffs'] = $cachedResult;
        }

        // Load a view and pass the data to it
        return view('staff/cache_index', $data);
        */
    }
}
