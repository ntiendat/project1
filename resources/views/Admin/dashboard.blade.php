@extends('layouts.master')

@section('title') Profile @endsection

@section('content')

    @component('common-components.breadcrumb')
      @slot('title')<a href="{{route('dashboard')}}">Dashboard</a> @endslot
         @slot('title_li') Welcome to Qovex Dashboard   @endslot
     @endcomponent
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        </ol>
      </nav>
    
    <div class="row">
   <div class="col-xl-3">
      <div class="card">
         <div class="card-body">
            <div class="media">
               <div class="avatar-sm font-size-20 mr-3">
                  <span class="avatar-title bg-soft-primary text-primary rounded">
                  <i class="mdi mdi-tag-plus-outline"></i>
                  </span>
               </div>
               <div class="media-body">
                  <div class="font-size-16 mt-2">New Orders</div>
               </div>
            </div>
            <h4 class="mt-4">1,368</h4>
            <div class="row">
               <div class="col-7">
                  <p class="mb-0"><span class="text-success mr-2"> 0.28% <i class="mdi mdi-arrow-up"></i> </span></p>
               </div>
               <div class="col-5 align-self-center">
                  <div class="progress progress-sm">
                     <div class="progress-bar bg-primary" role="progressbar" style="width: 62%" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="card">
         <div class="card-body">
            <div class="media">
               <div class="avatar-sm font-size-20 mr-3">
                  <span class="avatar-title bg-soft-primary text-primary rounded">
                  <i class="mdi mdi-account-multiple-outline"></i>
                  </span>
               </div>
               <div class="media-body">
                  <div class="font-size-16 mt-2">New Users</div>
               </div>
            </div>
            <h4 class="mt-4">2,456</h4>
            <div class="row">
               <div class="col-7">
                  <p class="mb-0"><span class="text-success mr-2"> 0.16% <i class="mdi mdi-arrow-up"></i> </span></p>
               </div>
               <div class="col-5 align-self-center">
                  <div class="progress progress-sm">
                     <div class="progress-bar bg-success" role="progressbar" style="width: 62%" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="col-xl-6">
      <div class="card">
         <div class="card-body" style="position: relative;">
            <h4 class="card-title mb-4">Sales Report</h4>
            <div id="line-chart" class="apex-charts" style="min-height: 275px;">
               <div id="apexchartsho9py283" class="apexcharts-canvas apexchartsho9py283 apexcharts-theme-light" style="width: 428px; height: 260px;">
                  <svg id="SvgjsSvg1838" width="428" height="260" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;">
                     <foreignObject x="0" y="0" width="428" height="260">
                        <div class="apexcharts-legend apexcharts-align-right position-top" xmlns="http://www.w3.org/1999/xhtml" style="right: 0px; position: absolute; left: 0px; top: 0px;">
                           <div class="apexcharts-legend-series" rel="1" data:collapsed="false" style="margin: 0px 5px;"><span class="apexcharts-legend-marker" rel="1" data:collapsed="false" style="background: rgb(69, 203, 133); color: rgb(69, 203, 133); height: 12px; width: 12px; left: 0px; top: 0px; border-width: 0px; border-color: rgb(255, 255, 255); border-radius: 12px;"></span><span class="apexcharts-legend-text" rel="1" i="0" data:default-text="2018" data:collapsed="false" style="color: rgb(55, 61, 63); font-size: 12px; font-weight: 400; font-family: Helvetica, Arial, sans-serif;">2018</span></div>
                           <div class="apexcharts-legend-series" rel="2" data:collapsed="false" style="margin: 0px 5px;"><span class="apexcharts-legend-marker" rel="2" data:collapsed="false" style="background: rgb(59, 93, 231); color: rgb(59, 93, 231); height: 12px; width: 12px; left: 0px; top: 0px; border-width: 0px; border-color: rgb(255, 255, 255); border-radius: 12px;"></span><span class="apexcharts-legend-text" rel="2" i="1" data:default-text="2019" data:collapsed="false" style="color: rgb(55, 61, 63); font-size: 12px; font-weight: 400; font-family: Helvetica, Arial, sans-serif;">2019</span></div>
                        </div>
                        <style type="text/css"> 
                           .apexcharts-legend { 
                           display: flex;   
                           overflow: auto;  
                           padding: 0 10px; 
                           }    
                           .apexcharts-legend.position-bottom, .apexcharts-legend.position-top {    
                           flex-wrap: wrap  
                           }    
                           .apexcharts-legend.position-right, .apexcharts-legend.position-left {    
                           flex-direction: column;  
                           bottom: 0;   
                           }    
                           .apexcharts-legend.position-bottom.apexcharts-align-left, .apexcharts-legend.position-top.apexcharts-align-left, .apexcharts-legend.position-right, .apexcharts-legend.position-left {   
                           justify-content: flex-start; 
                           }    
                           .apexcharts-legend.position-bottom.apexcharts-align-center, .apexcharts-legend.position-top.apexcharts-align-center {    
                           justify-content: center;     
                           }    
                           .apexcharts-legend.position-bottom.apexcharts-align-right, .apexcharts-legend.position-top.apexcharts-align-right {  
                           justify-content: flex-end;   
                           }    
                           .apexcharts-legend-series {  
                           cursor: pointer; 
                           line-height: normal; 
                           }    
                           .apexcharts-legend.position-bottom .apexcharts-legend-series, .apexcharts-legend.position-top .apexcharts-legend-series{ 
                           display: flex;   
                           align-items: center; 
                           }    
                           .apexcharts-legend-text {    
                           position: relative;  
                           font-size: 14px; 
                           }    
                           .apexcharts-legend-text *, .apexcharts-legend-marker * { 
                           pointer-events: none;    
                           }    
                           .apexcharts-legend-marker {  
                           position: relative;  
                           display: inline-block;   
                           cursor: pointer; 
                           margin-right: 3px;   
                           border-style: solid;
                           }    
                           .apexcharts-legend.apexcharts-align-right .apexcharts-legend-series, .apexcharts-legend.apexcharts-align-left .apexcharts-legend-series{ 
                           display: inline-block;   
                           }    
                           .apexcharts-legend-series.apexcharts-no-click {  
                           cursor: auto;    
                           }    
                           .apexcharts-legend .apexcharts-hidden-zero-series, .apexcharts-legend .apexcharts-hidden-null-series {   
                           display: none !important;    
                           }    
                           .apexcharts-inactive-legend {    
                           opacity: 0.45;   
                           }
                        </style>
                     </foreignObject>
                     <g id="SvgjsG1840" class="apexcharts-inner apexcharts-graphical" transform="translate(41.015625, 46)">
                        <defs id="SvgjsDefs1839">
                           <clipPath id="gridRectMaskho9py283">
                              <rect id="SvgjsRect1847" width="364.9218753004" height="153.6963" x="-3.5" y="-1.5" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                           </clipPath>
                           <clipPath id="gridRectMarkerMaskho9py283">
                              <rect id="SvgjsRect1848" width="380.921875" height="169.696" x="-8" y="-8" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                           </clipPath>
                        </defs>
                        <line id="SvgjsLine1846" x1="-0.5" y1="0" x2="-0.5" y2="153.696" stroke="#b6b6b6" stroke-dasharray="3" class="apexcharts-xcrosshairs" x="-0.5" y="0" width="1" height="153.696" fill="#b1b9c4" filter="none" fill-opacity="0.9" stroke-width="1"></line>
                        <g id="SvgjsG1891" class="apexcharts-xaxis" transform="translate(0, 0)">
                           <g id="SvgjsG1892" class="apexcharts-xaxis-texts-g" transform="translate(0, -4)">
                              <text id="SvgjsText1894" font-family="Helvetica, Arial, sans-serif" x="0" y="182.696" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                 <tspan id="SvgjsTspan1895">Jan</tspan>
                                 <title>Jan</title>
                              </text>
                              <text id="SvgjsText1897" font-family="Helvetica, Arial, sans-serif" x="52.13169642857142" y="182.696" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                 <tspan id="SvgjsTspan1898">Feb</tspan>
                                 <title>Feb</title>
                              </text>
                              <text id="SvgjsText1900" font-family="Helvetica, Arial, sans-serif" x="104.26339285714283" y="182.696" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                 <tspan id="SvgjsTspan1901">Mar</tspan>
                                 <title>Mar</title>
                              </text>
                              <text id="SvgjsText1903" font-family="Helvetica, Arial, sans-serif" x="156.39508928571428" y="182.696" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                 <tspan id="SvgjsTspan1904">Apr</tspan>
                                 <title>Apr</title>
                              </text>
                              <text id="SvgjsText1906" font-family="Helvetica, Arial, sans-serif" x="208.52678571428572" y="182.696" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                 <tspan id="SvgjsTspan1907">May</tspan>
                                 <title>May</title>
                              </text>
                              <text id="SvgjsText1909" font-family="Helvetica, Arial, sans-serif" x="260.65848214285717" y="182.696" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                 <tspan id="SvgjsTspan1910">Jun</tspan>
                                 <title>Jun</title>
                              </text>
                              <text id="SvgjsText1912" font-family="Helvetica, Arial, sans-serif" x="312.7901785714286" y="182.696" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                 <tspan id="SvgjsTspan1913">Jul</tspan>
                                 <title>Jul</title>
                              </text>
                              <text id="SvgjsText1915" font-family="Helvetica, Arial, sans-serif" x="364.92187500000006" y="182.696" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                 <tspan id="SvgjsTspan1916">Aug</tspan>
                                 <title>Aug</title>
                              </text>
                           </g>
                           <g id="SvgjsG1917" class="apexcharts-xaxis-title">
                              <text id="SvgjsText1918" font-family="Helvetica, Arial, sans-serif" x="182.4609375" y="198" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="900" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-title-text " style="font-family: Helvetica, Arial, sans-serif;">Month</text>
                           </g>
                           <line id="SvgjsLine1919" x1="0" y1="154.696" x2="364.921875" y2="154.696" stroke="#e0e0e0" stroke-dasharray="0" stroke-width="1"></line>
                        </g>
                        <g id="SvgjsG1934" class="apexcharts-grid">
                           <g id="SvgjsG1935" class="apexcharts-gridlines-horizontal">
                              <line id="SvgjsLine1945" x1="0" y1="0" x2="364.921875" y2="0" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line>
                              <line id="SvgjsLine1946" x1="0" y1="30.7392" x2="364.921875" y2="30.7392" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line>
                              <line id="SvgjsLine1947" x1="0" y1="61.4784" x2="364.921875" y2="61.4784" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line>
                              <line id="SvgjsLine1948" x1="0" y1="92.2176" x2="364.921875" y2="92.2176" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line>
                              <line id="SvgjsLine1949" x1="0" y1="122.9568" x2="364.921875" y2="122.9568" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line>
                              <line id="SvgjsLine1950" x1="0" y1="153.696" x2="364.921875" y2="153.696" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line>
                           </g>
                           <g id="SvgjsG1936" class="apexcharts-gridlines-vertical"></g>
                           <line id="SvgjsLine1937" x1="0" y1="154.696" x2="0" y2="160.696" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-xaxis-tick"></line>
                           <line id="SvgjsLine1938" x1="52.13169642857143" y1="154.696" x2="52.13169642857143" y2="160.696" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-xaxis-tick"></line>
                           <line id="SvgjsLine1939" x1="104.26339285714286" y1="154.696" x2="104.26339285714286" y2="160.696" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-xaxis-tick"></line>
                           <line id="SvgjsLine1940" x1="156.39508928571428" y1="154.696" x2="156.39508928571428" y2="160.696" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-xaxis-tick"></line>
                           <line id="SvgjsLine1941" x1="208.52678571428572" y1="154.696" x2="208.52678571428572" y2="160.696" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-xaxis-tick"></line>
                           <line id="SvgjsLine1942" x1="260.65848214285717" y1="154.696" x2="260.65848214285717" y2="160.696" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-xaxis-tick"></line>
                           <line id="SvgjsLine1943" x1="312.7901785714286" y1="154.696" x2="312.7901785714286" y2="160.696" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-xaxis-tick"></line>
                           <line id="SvgjsLine1944" x1="364.92187500000006" y1="154.696" x2="364.92187500000006" y2="160.696" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-xaxis-tick"></line>
                           <line id="SvgjsLine1952" x1="0" y1="153.696" x2="364.921875" y2="153.696" stroke="transparent" stroke-dasharray="0"></line>
                           <line id="SvgjsLine1951" x1="0" y1="1" x2="0" y2="153.696" stroke="transparent" stroke-dasharray="0"></line>
                        </g>
                        <g id="SvgjsG1850" class="apexcharts-area-series apexcharts-plot-series">
                           <g id="SvgjsG1851" class="apexcharts-series" seriesName="2019" data:longestSeries="true" rel="1" data:realIndex="1">
                              <path id="SvgjsPath1869" d="M 0 153.696L 0 153.696C 18.24609375 153.696 33.88560267857143 110.66112000000001 52.13169642857143 110.66112000000001C 70.37779017857143 110.66112000000001 86.01729910714286 132.17856 104.26339285714286 132.17856C 122.50948660714286 132.17856 138.14899553571428 33.81312 156.39508928571428 33.81312C 174.64118303571428 33.81312 190.28069196428572 101.43936000000001 208.52678571428572 101.43936000000001C 226.77287946428572 101.43936000000001 242.4123883928571 135.25248 260.6584821428571 135.25248C 278.9045758928571 135.25248 294.54408482142856 98.36544 312.79017857142856 98.36544C 331.03627232142856 98.36544 346.67578125 138.3264 364.921875 138.3264C 364.921875 138.3264 364.921875 138.3264 364.921875 153.696M 364.921875 138.3264z" fill="rgba(59,93,231,0.1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-area" index="1" clip-path="url(#gridRectMaskho9py283)" pathTo="M 0 153.696L 0 153.696C 18.24609375 153.696 33.88560267857143 110.66112000000001 52.13169642857143 110.66112000000001C 70.37779017857143 110.66112000000001 86.01729910714286 132.17856 104.26339285714286 132.17856C 122.50948660714286 132.17856 138.14899553571428 33.81312 156.39508928571428 33.81312C 174.64118303571428 33.81312 190.28069196428572 101.43936000000001 208.52678571428572 101.43936000000001C 226.77287946428572 101.43936000000001 242.4123883928571 135.25248 260.6584821428571 135.25248C 278.9045758928571 135.25248 294.54408482142856 98.36544 312.79017857142856 98.36544C 331.03627232142856 98.36544 346.67578125 138.3264 364.921875 138.3264C 364.921875 138.3264 364.921875 138.3264 364.921875 153.696M 364.921875 138.3264z" pathFrom="M -1 184.4352L -1 184.4352L 52.13169642857143 184.4352L 104.26339285714286 184.4352L 156.39508928571428 184.4352L 208.52678571428572 184.4352L 260.6584821428571 184.4352L 312.79017857142856 184.4352L 364.921875 184.4352"></path>
                              <path id="SvgjsPath1870" d="M 0 153.696C 18.24609375 153.696 33.88560267857143 110.66112000000001 52.13169642857143 110.66112000000001C 70.37779017857143 110.66112000000001 86.01729910714286 132.17856 104.26339285714286 132.17856C 122.50948660714286 132.17856 138.14899553571428 33.81312 156.39508928571428 33.81312C 174.64118303571428 33.81312 190.28069196428572 101.43936000000001 208.52678571428572 101.43936000000001C 226.77287946428572 101.43936000000001 242.4123883928571 135.25248 260.6584821428571 135.25248C 278.9045758928571 135.25248 294.54408482142856 98.36544 312.79017857142856 98.36544C 331.03627232142856 98.36544 346.67578125 138.3264 364.921875 138.3264" fill="none" fill-opacity="1" stroke="#3b5de7" stroke-opacity="1" stroke-linecap="butt" stroke-width="3" stroke-dasharray="0" class="apexcharts-area" index="1" clip-path="url(#gridRectMaskho9py283)" pathTo="M 0 153.696C 18.24609375 153.696 33.88560267857143 110.66112000000001 52.13169642857143 110.66112000000001C 70.37779017857143 110.66112000000001 86.01729910714286 132.17856 104.26339285714286 132.17856C 122.50948660714286 132.17856 138.14899553571428 33.81312 156.39508928571428 33.81312C 174.64118303571428 33.81312 190.28069196428572 101.43936000000001 208.52678571428572 101.43936000000001C 226.77287946428572 101.43936000000001 242.4123883928571 135.25248 260.6584821428571 135.25248C 278.9045758928571 135.25248 294.54408482142856 98.36544 312.79017857142856 98.36544C 331.03627232142856 98.36544 346.67578125 138.3264 364.921875 138.3264" pathFrom="M -1 184.4352L -1 184.4352L 52.13169642857143 184.4352L 104.26339285714286 184.4352L 156.39508928571428 184.4352L 208.52678571428572 184.4352L 260.6584821428571 184.4352L 312.79017857142856 184.4352L 364.921875 184.4352"></path>
                              <g id="SvgjsG1852" class="apexcharts-series-markers-wrap" data:realIndex="1">
                                 <g id="SvgjsG1854" class="apexcharts-series-markers" clip-path="url(#gridRectMarkerMaskho9py283)">
                                    <circle id="SvgjsCircle1855" r="3" cx="0" cy="153.696" class="apexcharts-marker wycnquk2i" stroke="#ffffff" fill="#3b5de7" fill-opacity="1" stroke-width="2" stroke-opacity="0.9" rel="0" j="0" index="1" default-marker-size="3"></circle>
                                    <circle id="SvgjsCircle1856" r="3" cx="52.13169642857143" cy="110.66112000000001" class="apexcharts-marker w5n76ri14" stroke="#ffffff" fill="#3b5de7" fill-opacity="1" stroke-width="2" stroke-opacity="0.9" rel="1" j="1" index="1" default-marker-size="3"></circle>
                                 </g>
                                 <g id="SvgjsG1857" class="apexcharts-series-markers" clip-path="url(#gridRectMarkerMaskho9py283)">
                                    <circle id="SvgjsCircle1858" r="3" cx="104.26339285714286" cy="132.17856" class="apexcharts-marker wgkq1v2ie" stroke="#ffffff" fill="#3b5de7" fill-opacity="1" stroke-width="2" stroke-opacity="0.9" rel="2" j="2" index="1" default-marker-size="3"></circle>
                                 </g>
                                 <g id="SvgjsG1859" class="apexcharts-series-markers" clip-path="url(#gridRectMarkerMaskho9py283)">
                                    <circle id="SvgjsCircle1860" r="3" cx="156.39508928571428" cy="33.81312" class="apexcharts-marker wu26vs18f" stroke="#ffffff" fill="#3b5de7" fill-opacity="1" stroke-width="2" stroke-opacity="0.9" rel="3" j="3" index="1" default-marker-size="3"></circle>
                                 </g>
                                 <g id="SvgjsG1861" class="apexcharts-series-markers" clip-path="url(#gridRectMarkerMaskho9py283)">
                                    <circle id="SvgjsCircle1862" r="3" cx="208.52678571428572" cy="101.43936000000001" class="apexcharts-marker wvh7abfff" stroke="#ffffff" fill="#3b5de7" fill-opacity="1" stroke-width="2" stroke-opacity="0.9" rel="4" j="4" index="1" default-marker-size="3"></circle>
                                 </g>
                                 <g id="SvgjsG1863" class="apexcharts-series-markers" clip-path="url(#gridRectMarkerMaskho9py283)">
                                    <circle id="SvgjsCircle1864" r="3" cx="260.6584821428571" cy="135.25248" class="apexcharts-marker wavmzxhen" stroke="#ffffff" fill="#3b5de7" fill-opacity="1" stroke-width="2" stroke-opacity="0.9" rel="5" j="5" index="1" default-marker-size="3"></circle>
                                 </g>
                                 <g id="SvgjsG1865" class="apexcharts-series-markers" clip-path="url(#gridRectMarkerMaskho9py283)">
                                    <circle id="SvgjsCircle1866" r="3" cx="312.79017857142856" cy="98.36544" class="apexcharts-marker wkwcjofqzj" stroke="#ffffff" fill="#3b5de7" fill-opacity="1" stroke-width="2" stroke-opacity="0.9" rel="6" j="6" index="1" default-marker-size="3"></circle>
                                 </g>
                                 <g id="SvgjsG1867" class="apexcharts-series-markers" clip-path="url(#gridRectMarkerMaskho9py283)">
                                    <circle id="SvgjsCircle1868" r="3" cx="364.921875" cy="138.3264" class="apexcharts-marker w1yh6oild" stroke="#ffffff" fill="#3b5de7" fill-opacity="1" stroke-width="2" stroke-opacity="0.9" rel="7" j="7" index="1" default-marker-size="3"></circle>
                                 </g>
                              </g>
                           </g>
                        </g>
                        <g id="SvgjsG1871" class="apexcharts-line-series apexcharts-plot-series">
                           <g id="SvgjsG1872" class="apexcharts-series" seriesName="2018" data:longestSeries="true" rel="1" data:realIndex="0">
                              <path id="SvgjsPath1890" d="M 0 122.95680000000002C 18.24609375 122.95680000000002 33.88560267857143 79.92192000000001 52.13169642857143 79.92192000000001C 70.37779017857143 79.92192000000001 86.01729910714286 101.43936000000001 104.26339285714286 101.43936000000001C 122.50948660714286 101.43936000000001 138.14899553571428 3.0739200000000153 156.39508928571428 3.0739200000000153C 174.64118303571428 3.0739200000000153 190.28069196428572 70.70016000000001 208.52678571428572 70.70016000000001C 226.77287946428572 70.70016000000001 242.4123883928571 104.51328000000001 260.6584821428571 104.51328000000001C 278.9045758928571 104.51328000000001 294.54408482142856 67.62624000000001 312.79017857142856 67.62624000000001C 331.03627232142856 67.62624000000001 346.67578125 107.58720000000001 364.921875 107.58720000000001" fill="none" fill-opacity="1" stroke="rgba(69,203,133,1)" stroke-opacity="1" stroke-linecap="butt" stroke-width="3" stroke-dasharray="4" class="apexcharts-line" index="0" clip-path="url(#gridRectMaskho9py283)" pathTo="M 0 122.95680000000002C 18.24609375 122.95680000000002 33.88560267857143 79.92192000000001 52.13169642857143 79.92192000000001C 70.37779017857143 79.92192000000001 86.01729910714286 101.43936000000001 104.26339285714286 101.43936000000001C 122.50948660714286 101.43936000000001 138.14899553571428 3.0739200000000153 156.39508928571428 3.0739200000000153C 174.64118303571428 3.0739200000000153 190.28069196428572 70.70016000000001 208.52678571428572 70.70016000000001C 226.77287946428572 70.70016000000001 242.4123883928571 104.51328000000001 260.6584821428571 104.51328000000001C 278.9045758928571 104.51328000000001 294.54408482142856 67.62624000000001 312.79017857142856 67.62624000000001C 331.03627232142856 67.62624000000001 346.67578125 107.58720000000001 364.921875 107.58720000000001" pathFrom="M -1 184.4352L -1 184.4352L 52.13169642857143 184.4352L 104.26339285714286 184.4352L 156.39508928571428 184.4352L 208.52678571428572 184.4352L 260.6584821428571 184.4352L 312.79017857142856 184.4352L 364.921875 184.4352"></path>
                              <g id="SvgjsG1873" class="apexcharts-series-markers-wrap" data:realIndex="0">
                                 <g id="SvgjsG1875" class="apexcharts-series-markers" clip-path="url(#gridRectMarkerMaskho9py283)">
                                    <circle id="SvgjsCircle1876" r="3" cx="0" cy="122.95680000000002" class="apexcharts-marker wmvofmfna" stroke="#ffffff" fill="#45cb85" fill-opacity="1" stroke-width="2" stroke-opacity="0.9" rel="0" j="0" index="0" default-marker-size="3"></circle>
                                    <circle id="SvgjsCircle1877" r="3" cx="52.13169642857143" cy="79.92192000000001" class="apexcharts-marker wwf7hm9hzk" stroke="#ffffff" fill="#45cb85" fill-opacity="1" stroke-width="2" stroke-opacity="0.9" rel="1" j="1" index="0" default-marker-size="3"></circle>
                                 </g>
                                 <g id="SvgjsG1878" class="apexcharts-series-markers" clip-path="url(#gridRectMarkerMaskho9py283)">
                                    <circle id="SvgjsCircle1879" r="3" cx="104.26339285714286" cy="101.43936000000001" class="apexcharts-marker walkjbc2h" stroke="#ffffff" fill="#45cb85" fill-opacity="1" stroke-width="2" stroke-opacity="0.9" rel="2" j="2" index="0" default-marker-size="3"></circle>
                                 </g>
                                 <g id="SvgjsG1880" class="apexcharts-series-markers" clip-path="url(#gridRectMarkerMaskho9py283)">
                                    <circle id="SvgjsCircle1881" r="3" cx="156.39508928571428" cy="3.0739200000000153" class="apexcharts-marker wn74wb7vd" stroke="#ffffff" fill="#45cb85" fill-opacity="1" stroke-width="2" stroke-opacity="0.9" rel="3" j="3" index="0" default-marker-size="3"></circle>
                                 </g>
                                 <g id="SvgjsG1882" class="apexcharts-series-markers" clip-path="url(#gridRectMarkerMaskho9py283)">
                                    <circle id="SvgjsCircle1883" r="3" cx="208.52678571428572" cy="70.70016000000001" class="apexcharts-marker wcpsbdi5oh" stroke="#ffffff" fill="#45cb85" fill-opacity="1" stroke-width="2" stroke-opacity="0.9" rel="4" j="4" index="0" default-marker-size="3"></circle>
                                 </g>
                                 <g id="SvgjsG1884" class="apexcharts-series-markers" clip-path="url(#gridRectMarkerMaskho9py283)">
                                    <circle id="SvgjsCircle1885" r="3" cx="260.6584821428571" cy="104.51328000000001" class="apexcharts-marker wtyvzy86x" stroke="#ffffff" fill="#45cb85" fill-opacity="1" stroke-width="2" stroke-opacity="0.9" rel="5" j="5" index="0" default-marker-size="3"></circle>
                                 </g>
                                 <g id="SvgjsG1886" class="apexcharts-series-markers" clip-path="url(#gridRectMarkerMaskho9py283)">
                                    <circle id="SvgjsCircle1887" r="3" cx="312.79017857142856" cy="67.62624000000001" class="apexcharts-marker wxx62snma" stroke="#ffffff" fill="#45cb85" fill-opacity="1" stroke-width="2" stroke-opacity="0.9" rel="6" j="6" index="0" default-marker-size="3"></circle>
                                 </g>
                                 <g id="SvgjsG1888" class="apexcharts-series-markers" clip-path="url(#gridRectMarkerMaskho9py283)">
                                    <circle id="SvgjsCircle1889" r="3" cx="364.921875" cy="107.58720000000001" class="apexcharts-marker wpxgml342" stroke="#ffffff" fill="#45cb85" fill-opacity="1" stroke-width="2" stroke-opacity="0.9" rel="7" j="7" index="0" default-marker-size="3"></circle>
                                 </g>
                              </g>
                              <g id="SvgjsG1874" class="apexcharts-datalabels" data:realIndex="0"></g>
                           </g>
                           <g id="SvgjsG1853" class="apexcharts-datalabels" data:realIndex="1"></g>
                        </g>
                        <line id="SvgjsLine1953" x1="0" y1="0" x2="364.921875" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" class="apexcharts-ycrosshairs"></line>
                        <line id="SvgjsLine1954" x1="0" y1="0" x2="364.921875" y2="0" stroke-dasharray="0" stroke-width="0" class="apexcharts-ycrosshairs-hidden"></line>
                        <g id="SvgjsG1955" class="apexcharts-yaxis-annotations"></g>
                        <g id="SvgjsG1956" class="apexcharts-xaxis-annotations"></g>
                        <g id="SvgjsG1957" class="apexcharts-point-annotations"></g>
                     </g>
                     <rect id="SvgjsRect1845" width="0" height="0" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fefefe"></rect>
                     <g id="SvgjsG1920" class="apexcharts-yaxis" rel="0" transform="translate(11.015625, 0)">
                        <g id="SvgjsG1921" class="apexcharts-yaxis-texts-g">
                           <text id="SvgjsText1922" font-family="Helvetica, Arial, sans-serif" x="20" y="47.5" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                              <tspan id="SvgjsTspan1923">60</tspan>
                           </text>
                           <text id="SvgjsText1924" font-family="Helvetica, Arial, sans-serif" x="20" y="78.2392" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                              <tspan id="SvgjsTspan1925">50</tspan>
                           </text>
                           <text id="SvgjsText1926" font-family="Helvetica, Arial, sans-serif" x="20" y="108.9784" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                              <tspan id="SvgjsTspan1927">40</tspan>
                           </text>
                           <text id="SvgjsText1928" font-family="Helvetica, Arial, sans-serif" x="20" y="139.7176" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                              <tspan id="SvgjsTspan1929">30</tspan>
                           </text>
                           <text id="SvgjsText1930" font-family="Helvetica, Arial, sans-serif" x="20" y="170.45680000000002" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                              <tspan id="SvgjsTspan1931">20</tspan>
                           </text>
                           <text id="SvgjsText1932" font-family="Helvetica, Arial, sans-serif" x="20" y="201.19600000000003" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                              <tspan id="SvgjsTspan1933">10</tspan>
                           </text>
                        </g>
                     </g>
                     <g id="SvgjsG1841" class="apexcharts-annotations"></g>
                  </svg>
                  <div class="apexcharts-tooltip apexcharts-theme-light" style="left: 55.0156px; top: 96.696px;">
                     <div class="apexcharts-tooltip-title" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">Jan</div>
                     <div class="apexcharts-tooltip-series-group apexcharts-active" style="display: flex;">
                        <span class="apexcharts-tooltip-marker" style="background-color: rgb(69, 203, 133);"></span>
                        <div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                           <div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-label">2018: </span><span class="apexcharts-tooltip-text-value">20</span></div>
                           <div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div>
                        </div>
                     </div>
                     <div class="apexcharts-tooltip-series-group apexcharts-active" style="display: flex;">
                        <span class="apexcharts-tooltip-marker" style="background-color: rgb(59, 93, 231);"></span>
                        <div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                           <div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-label">2019: </span><span class="apexcharts-tooltip-text-value">10</span></div>
                           <div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div>
                        </div>
                     </div>
                  </div>
                  <div class="apexcharts-xaxistooltip apexcharts-xaxistooltip-bottom apexcharts-theme-light" style="left: 18.2969px; top: 201.696px;">
                     <div class="apexcharts-xaxistooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px; min-width: 23.4375px;">Jan</div>
                  </div>
                  <div class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-light">
                     <div class="apexcharts-yaxistooltip-text"></div>
                  </div>
               </div>
            </div>
            <div class="resize-triggers">
               <div class="expand-trigger">
                  <div style="width: 469px; height: 343px;"></div>
               </div>
               <div class="contract-trigger"></div>
            </div>
         </div>
      </div>
   </div>
   <div class="col-xl-3">
      <div class="card">
         <div class="card-body" style="position: relative;">
            <h4 class="card-title mb-4">Revenue</h4>
            <div id="column-chart" class="apex-charts" style="min-height: 275px;">
               <div id="apexchartsb7bw7j1y" class="apexcharts-canvas apexchartsb7bw7j1y apexcharts-theme-light" style="width: 182px; height: 260px;">
                  <svg id="SvgjsSvg1958" width="182" height="260" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;">
                     <foreignObject x="0" y="0" width="182" height="260">
                        <div class="apexcharts-legend apexcharts-align-center position-bottom" xmlns="http://www.w3.org/1999/xhtml" style="right: 0px; position: absolute; left: 0px; top: auto; bottom: 5px;">
                           <div class="apexcharts-legend-series" rel="1" data:collapsed="false" style="margin: 0px 5px;"><span class="apexcharts-legend-marker" rel="1" data:collapsed="false" style="background: rgb(238, 243, 247); color: rgb(238, 243, 247); height: 12px; width: 12px; left: 0px; top: 0px; border-width: 0px; border-color: rgb(255, 255, 255); border-radius: 2px;"></span><span class="apexcharts-legend-text" rel="1" i="0" data:default-text="Series%20A" data:collapsed="false" style="color: rgb(55, 61, 63); font-size: 12px; font-weight: 400; font-family: Helvetica, Arial, sans-serif;">Series A</span></div>
                           <div class="apexcharts-legend-series" rel="2" data:collapsed="false" style="margin: 0px 5px;"><span class="apexcharts-legend-marker" rel="2" data:collapsed="false" style="background: rgb(206, 214, 249); color: rgb(206, 214, 249); height: 12px; width: 12px; left: 0px; top: 0px; border-width: 0px; border-color: rgb(255, 255, 255); border-radius: 2px;"></span><span class="apexcharts-legend-text" rel="2" i="1" data:default-text="Series%20B" data:collapsed="false" style="color: rgb(55, 61, 63); font-size: 12px; font-weight: 400; font-family: Helvetica, Arial, sans-serif;">Series B</span></div>
                           <div class="apexcharts-legend-series" rel="3" data:collapsed="false" style="margin: 0px 5px;"><span class="apexcharts-legend-marker" rel="3" data:collapsed="false" style="background: rgb(59, 93, 231); color: rgb(59, 93, 231); height: 12px; width: 12px; left: 0px; top: 0px; border-width: 0px; border-color: rgb(255, 255, 255); border-radius: 2px;"></span><span class="apexcharts-legend-text" rel="3" i="2" data:default-text="Series%20C" data:collapsed="false" style="color: rgb(55, 61, 63); font-size: 12px; font-weight: 400; font-family: Helvetica, Arial, sans-serif;">Series C</span></div>
                        </div>
                        <style type="text/css"> 
                           .apexcharts-legend { 
                           display: flex;   
                           overflow: auto;  
                           padding: 0 10px; 
                           }    
                           .apexcharts-legend.position-bottom, .apexcharts-legend.position-top {    
                           flex-wrap: wrap  
                           }    
                           .apexcharts-legend.position-right, .apexcharts-legend.position-left {    
                           flex-direction: column;  
                           bottom: 0;   
                           }    
                           .apexcharts-legend.position-bottom.apexcharts-align-left, .apexcharts-legend.position-top.apexcharts-align-left, .apexcharts-legend.position-right, .apexcharts-legend.position-left {   
                           justify-content: flex-start; 
                           }    
                           .apexcharts-legend.position-bottom.apexcharts-align-center, .apexcharts-legend.position-top.apexcharts-align-center {    
                           justify-content: center;     
                           }    
                           .apexcharts-legend.position-bottom.apexcharts-align-right, .apexcharts-legend.position-top.apexcharts-align-right {  
                           justify-content: flex-end;   
                           }    
                           .apexcharts-legend-series {  
                           cursor: pointer; 
                           line-height: normal; 
                           }    
                           .apexcharts-legend.position-bottom .apexcharts-legend-series, .apexcharts-legend.position-top .apexcharts-legend-series{ 
                           display: flex;   
                           align-items: center; 
                           }    
                           .apexcharts-legend-text {    
                           position: relative;  
                           font-size: 14px; 
                           }    
                           .apexcharts-legend-text *, .apexcharts-legend-marker * { 
                           pointer-events: none;    
                           }    
                           .apexcharts-legend-marker {  
                           position: relative;  
                           display: inline-block;   
                           cursor: pointer; 
                           margin-right: 3px;   
                           border-style: solid;
                           }    
                           .apexcharts-legend.apexcharts-align-right .apexcharts-legend-series, .apexcharts-legend.apexcharts-align-left .apexcharts-legend-series{ 
                           display: inline-block;   
                           }    
                           .apexcharts-legend-series.apexcharts-no-click {  
                           cursor: auto;    
                           }    
                           .apexcharts-legend .apexcharts-hidden-zero-series, .apexcharts-legend .apexcharts-hidden-null-series {   
                           display: none !important;    
                           }    
                           .apexcharts-inactive-legend {    
                           opacity: 0.45;   
                           }
                        </style>
                     </foreignObject>
                     <g id="SvgjsG1960" class="apexcharts-inner apexcharts-graphical" transform="translate(46.0625, 40)">
                        <defs id="SvgjsDefs1959">
                           <linearGradient id="SvgjsLinearGradient1964" x1="0" y1="0" x2="0" y2="1">
                              <stop id="SvgjsStop1965" stop-opacity="0.4" stop-color="rgba(216,227,240,0.4)" offset="0"></stop>
                              <stop id="SvgjsStop1966" stop-opacity="0.5" stop-color="rgba(190,209,230,0.5)" offset="1"></stop>
                              <stop id="SvgjsStop1967" stop-opacity="0.5" stop-color="rgba(190,209,230,0.5)" offset="1"></stop>
                           </linearGradient>
                           <clipPath id="gridRectMaskb7bw7j1y">
                              <rect id="SvgjsRect1969" width="129.9375" height="152.348" x="-2" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                           </clipPath>
                           <clipPath id="gridRectMarkerMaskb7bw7j1y">
                              <rect id="SvgjsRect1970" width="129.9375" height="156.348" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                           </clipPath>
                        </defs>
                        <rect id="SvgjsRect1968" width="4.197916666666666" height="152.348" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke-dasharray="3" fill="url(#SvgjsLinearGradient1964)" class="apexcharts-xcrosshairs" y2="152.348" filter="none" fill-opacity="0.9"></rect>
                        <g id="SvgjsG1997" class="apexcharts-xaxis" transform="translate(0, 0)">
                           <g id="SvgjsG1998" class="apexcharts-xaxis-texts-g" transform="translate(0, -4)">
                              <text id="SvgjsText2000" font-family="Helvetica, Arial, sans-serif" x="10.494791666666666" y="181.348" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                 <tspan id="SvgjsTspan2001">Jan</tspan>
                                 <title>Jan</title>
                              </text>
                              <text id="SvgjsText2003" font-family="Helvetica, Arial, sans-serif" x="31.484375" y="181.348" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                 <tspan id="SvgjsTspan2004">Feb</tspan>
                                 <title>Feb</title>
                              </text>
                              <text id="SvgjsText2006" font-family="Helvetica, Arial, sans-serif" x="52.473958333333336" y="181.348" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                 <tspan id="SvgjsTspan2007">Mar</tspan>
                                 <title>Mar</title>
                              </text>
                              <text id="SvgjsText2009" font-family="Helvetica, Arial, sans-serif" x="73.46354166666666" y="181.348" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                 <tspan id="SvgjsTspan2010"></tspan>
                                 <title></title>
                              </text>
                              <text id="SvgjsText2012" font-family="Helvetica, Arial, sans-serif" x="94.45312499999999" y="181.348" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                 <tspan id="SvgjsTspan2013">May</tspan>
                                 <title>May</title>
                              </text>
                              <text id="SvgjsText2015" font-family="Helvetica, Arial, sans-serif" x="115.44270833333331" y="181.348" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                 <tspan id="SvgjsTspan2016"></tspan>
                                 <title></title>
                              </text>
                           </g>
                           <line id="SvgjsLine2017" x1="0" y1="153.348" x2="125.9375" y2="153.348" stroke="#e0e0e0" stroke-dasharray="0" stroke-width="1"></line>
                        </g>
                        <g id="SvgjsG2032" class="apexcharts-grid">
                           <g id="SvgjsG2033" class="apexcharts-gridlines-horizontal">
                              <line id="SvgjsLine2042" x1="0" y1="0" x2="125.9375" y2="0" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line>
                              <line id="SvgjsLine2043" x1="0" y1="30.469600000000003" x2="125.9375" y2="30.469600000000003" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line>
                              <line id="SvgjsLine2044" x1="0" y1="60.93920000000001" x2="125.9375" y2="60.93920000000001" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line>
                              <line id="SvgjsLine2045" x1="0" y1="91.40880000000001" x2="125.9375" y2="91.40880000000001" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line>
                              <line id="SvgjsLine2046" x1="0" y1="121.87840000000001" x2="125.9375" y2="121.87840000000001" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line>
                              <line id="SvgjsLine2047" x1="0" y1="152.348" x2="125.9375" y2="152.348" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line>
                           </g>
                           <g id="SvgjsG2034" class="apexcharts-gridlines-vertical"></g>
                           <line id="SvgjsLine2035" x1="0" y1="153.348" x2="0" y2="159.348" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-xaxis-tick"></line>
                           <line id="SvgjsLine2036" x1="20.989583333333332" y1="153.348" x2="20.989583333333332" y2="159.348" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-xaxis-tick"></line>
                           <line id="SvgjsLine2037" x1="41.979166666666664" y1="153.348" x2="41.979166666666664" y2="159.348" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-xaxis-tick"></line>
                           <line id="SvgjsLine2038" x1="62.96875" y1="153.348" x2="62.96875" y2="159.348" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-xaxis-tick"></line>
                           <line id="SvgjsLine2039" x1="83.95833333333333" y1="153.348" x2="83.95833333333333" y2="159.348" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-xaxis-tick"></line>
                           <line id="SvgjsLine2040" x1="104.94791666666666" y1="153.348" x2="104.94791666666666" y2="159.348" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-xaxis-tick"></line>
                           <line id="SvgjsLine2041" x1="125.93749999999999" y1="153.348" x2="125.93749999999999" y2="159.348" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-xaxis-tick"></line>
                           <line id="SvgjsLine2049" x1="0" y1="152.348" x2="125.9375" y2="152.348" stroke="transparent" stroke-dasharray="0"></line>
                           <line id="SvgjsLine2048" x1="0" y1="1" x2="0" y2="152.348" stroke="transparent" stroke-dasharray="0"></line>
                        </g>
                        <g id="SvgjsG1972" class="apexcharts-bar-series apexcharts-plot-series">
                           <g id="SvgjsG1973" class="apexcharts-series" seriesName="SeriesxA" rel="1" data:realIndex="0">
                              <path id="SvgjsPath1975" d="M 8.395833333333332 152.348L 8.395833333333332 136.63919916666666Q 10.494791666666664 134.5402408333333 12.593749999999998 136.63919916666666L 12.593749999999998 136.63919916666666L 12.593749999999998 152.348L 12.593749999999998 152.348z" fill="rgba(238,243,247,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="square" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskb7bw7j1y)" pathTo="M 8.395833333333332 152.348L 8.395833333333332 136.63919916666666Q 10.494791666666664 134.5402408333333 12.593749999999998 136.63919916666666L 12.593749999999998 136.63919916666666L 12.593749999999998 152.348L 12.593749999999998 152.348z" pathFrom="M 8.395833333333332 152.348L 8.395833333333332 152.348L 12.593749999999998 152.348L 12.593749999999998 152.348L 12.593749999999998 152.348L 8.395833333333332 152.348" cy="135.58972" cx="29.385416666666664" j="0" val="11" barHeight="16.758280000000003" barWidth="4.197916666666666"></path>
                              <path id="SvgjsPath1976" d="M 29.385416666666664 152.348L 29.385416666666664 127.49831916666669Q 31.484374999999996 125.39936083333336 33.58333333333333 127.49831916666669L 33.58333333333333 127.49831916666669L 33.58333333333333 152.348L 33.58333333333333 152.348z" fill="rgba(238,243,247,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="square" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskb7bw7j1y)" pathTo="M 29.385416666666664 152.348L 29.385416666666664 127.49831916666669Q 31.484374999999996 125.39936083333336 33.58333333333333 127.49831916666669L 33.58333333333333 127.49831916666669L 33.58333333333333 152.348L 33.58333333333333 152.348z" pathFrom="M 29.385416666666664 152.348L 29.385416666666664 152.348L 33.58333333333333 152.348L 33.58333333333333 152.348L 33.58333333333333 152.348L 29.385416666666664 152.348" cy="126.44884000000002" cx="50.375" j="1" val="17" barHeight="25.899160000000002" barWidth="4.197916666666666"></path>
                              <path id="SvgjsPath1977" d="M 50.375 152.348L 50.375 130.54527916666666Q 52.473958333333336 128.44632083333332 54.572916666666664 130.54527916666666L 54.572916666666664 130.54527916666666L 54.572916666666664 152.348L 54.572916666666664 152.348z" fill="rgba(238,243,247,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="square" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskb7bw7j1y)" pathTo="M 50.375 152.348L 50.375 130.54527916666666Q 52.473958333333336 128.44632083333332 54.572916666666664 130.54527916666666L 54.572916666666664 130.54527916666666L 54.572916666666664 152.348L 54.572916666666664 152.348z" pathFrom="M 50.375 152.348L 50.375 152.348L 54.572916666666664 152.348L 54.572916666666664 152.348L 54.572916666666664 152.348L 50.375 152.348" cy="129.4958" cx="71.36458333333333" j="2" val="15" barHeight="22.852200000000003" barWidth="4.197916666666666"></path>
                              <path id="SvgjsPath1978" d="M 71.36458333333333 152.348L 71.36458333333333 130.54527916666666Q 73.46354166666666 128.44632083333332 75.5625 130.54527916666666L 75.5625 130.54527916666666L 75.5625 152.348L 75.5625 152.348z" fill="rgba(238,243,247,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="square" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskb7bw7j1y)" pathTo="M 71.36458333333333 152.348L 71.36458333333333 130.54527916666666Q 73.46354166666666 128.44632083333332 75.5625 130.54527916666666L 75.5625 130.54527916666666L 75.5625 152.348L 75.5625 152.348z" pathFrom="M 71.36458333333333 152.348L 71.36458333333333 152.348L 75.5625 152.348L 75.5625 152.348L 75.5625 152.348L 71.36458333333333 152.348" cy="129.4958" cx="92.35416666666666" j="3" val="15" barHeight="22.852200000000003" barWidth="4.197916666666666"></path>
                              <path id="SvgjsPath1979" d="M 92.35416666666666 152.348L 92.35416666666666 121.40439916666668Q 94.45312499999999 119.30544083333335 96.55208333333333 121.40439916666668L 96.55208333333333 121.40439916666668L 96.55208333333333 152.348L 96.55208333333333 152.348z" fill="rgba(238,243,247,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="square" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskb7bw7j1y)" pathTo="M 92.35416666666666 152.348L 92.35416666666666 121.40439916666668Q 94.45312499999999 119.30544083333335 96.55208333333333 121.40439916666668L 96.55208333333333 121.40439916666668L 96.55208333333333 152.348L 96.55208333333333 152.348z" pathFrom="M 92.35416666666666 152.348L 92.35416666666666 152.348L 96.55208333333333 152.348L 96.55208333333333 152.348L 96.55208333333333 152.348L 92.35416666666666 152.348" cy="120.35492" cx="113.34374999999999" j="4" val="21" barHeight="31.993080000000003" barWidth="4.197916666666666"></path>
                              <path id="SvgjsPath1980" d="M 113.34374999999999 152.348L 113.34374999999999 132.06875916666667Q 115.44270833333331 129.96980083333332 117.54166666666666 132.06875916666667L 117.54166666666666 132.06875916666667L 117.54166666666666 152.348L 117.54166666666666 152.348z" fill="rgba(238,243,247,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="square" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskb7bw7j1y)" pathTo="M 113.34374999999999 152.348L 113.34374999999999 132.06875916666667Q 115.44270833333331 129.96980083333332 117.54166666666666 132.06875916666667L 117.54166666666666 132.06875916666667L 117.54166666666666 152.348L 117.54166666666666 152.348z" pathFrom="M 113.34374999999999 152.348L 113.34374999999999 152.348L 117.54166666666666 152.348L 117.54166666666666 152.348L 117.54166666666666 152.348L 113.34374999999999 152.348" cy="131.01928" cx="134.33333333333331" j="5" val="14" barHeight="21.328720000000004" barWidth="4.197916666666666"></path>
                           </g>
                           <g id="SvgjsG1981" class="apexcharts-series" seriesName="SeriesxB" rel="2" data:realIndex="1">
                              <path id="SvgjsPath1983" d="M 8.395833333333332 135.58972L 8.395833333333332 116.83395916666667Q 10.494791666666664 114.73500083333334 12.593749999999998 116.83395916666667L 12.593749999999998 116.83395916666667L 12.593749999999998 135.58972L 12.593749999999998 135.58972z" fill="rgba(206,214,249,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="square" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="1" clip-path="url(#gridRectMaskb7bw7j1y)" pathTo="M 8.395833333333332 135.58972L 8.395833333333332 116.83395916666667Q 10.494791666666664 114.73500083333334 12.593749999999998 116.83395916666667L 12.593749999999998 116.83395916666667L 12.593749999999998 135.58972L 12.593749999999998 135.58972z" pathFrom="M 8.395833333333332 135.58972L 8.395833333333332 135.58972L 12.593749999999998 135.58972L 12.593749999999998 135.58972L 12.593749999999998 135.58972L 8.395833333333332 135.58972" cy="115.78448" cx="29.385416666666664" j="0" val="13" barHeight="19.80524" barWidth="4.197916666666666"></path>
                              <path id="SvgjsPath1984" d="M 29.385416666666664 126.44884000000002L 29.385416666666664 92.45827916666669Q 31.484374999999996 90.35932083333336 33.58333333333333 92.45827916666669L 33.58333333333333 92.45827916666669L 33.58333333333333 126.44884000000002L 33.58333333333333 126.44884000000002z" fill="rgba(206,214,249,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="square" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="1" clip-path="url(#gridRectMaskb7bw7j1y)" pathTo="M 29.385416666666664 126.44884000000002L 29.385416666666664 92.45827916666669Q 31.484374999999996 90.35932083333336 33.58333333333333 92.45827916666669L 33.58333333333333 92.45827916666669L 33.58333333333333 126.44884000000002L 33.58333333333333 126.44884000000002z" pathFrom="M 29.385416666666664 126.44884000000002L 29.385416666666664 126.44884000000002L 33.58333333333333 126.44884000000002L 33.58333333333333 126.44884000000002L 33.58333333333333 126.44884000000002L 29.385416666666664 126.44884000000002" cy="91.40880000000001" cx="50.375" j="1" val="23" barHeight="35.040040000000005" barWidth="4.197916666666666"></path>
                              <path id="SvgjsPath1985" d="M 50.375 129.4958L 50.375 100.07567916666667Q 52.473958333333336 97.97672083333335 54.572916666666664 100.07567916666667L 54.572916666666664 100.07567916666667L 54.572916666666664 129.4958L 54.572916666666664 129.4958z" fill="rgba(206,214,249,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="square" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="1" clip-path="url(#gridRectMaskb7bw7j1y)" pathTo="M 50.375 129.4958L 50.375 100.07567916666667Q 52.473958333333336 97.97672083333335 54.572916666666664 100.07567916666667L 54.572916666666664 100.07567916666667L 54.572916666666664 129.4958L 54.572916666666664 129.4958z" pathFrom="M 50.375 129.4958L 50.375 129.4958L 54.572916666666664 129.4958L 54.572916666666664 129.4958L 54.572916666666664 129.4958L 50.375 129.4958" cy="99.0262" cx="71.36458333333333" j="2" val="20" barHeight="30.469600000000003" barWidth="4.197916666666666"></path>
                              <path id="SvgjsPath1986" d="M 71.36458333333333 129.4958L 71.36458333333333 118.35743916666668Q 73.46354166666666 116.25848083333335 75.5625 118.35743916666668L 75.5625 118.35743916666668L 75.5625 129.4958L 75.5625 129.4958z" fill="rgba(206,214,249,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="square" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="1" clip-path="url(#gridRectMaskb7bw7j1y)" pathTo="M 71.36458333333333 129.4958L 71.36458333333333 118.35743916666668Q 73.46354166666666 116.25848083333335 75.5625 118.35743916666668L 75.5625 118.35743916666668L 75.5625 129.4958L 75.5625 129.4958z" pathFrom="M 71.36458333333333 129.4958L 71.36458333333333 129.4958L 75.5625 129.4958L 75.5625 129.4958L 75.5625 129.4958L 71.36458333333333 129.4958" cy="117.30796000000001" cx="92.35416666666666" j="3" val="8" barHeight="12.187840000000001" barWidth="4.197916666666666"></path>
                              <path id="SvgjsPath1987" d="M 92.35416666666666 120.35492L 92.35416666666666 101.59915916666668Q 94.45312499999999 99.50020083333335 96.55208333333333 101.59915916666668L 96.55208333333333 101.59915916666668L 96.55208333333333 120.35492L 96.55208333333333 120.35492z" fill="rgba(206,214,249,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="square" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="1" clip-path="url(#gridRectMaskb7bw7j1y)" pathTo="M 92.35416666666666 120.35492L 92.35416666666666 101.59915916666668Q 94.45312499999999 99.50020083333335 96.55208333333333 101.59915916666668L 96.55208333333333 101.59915916666668L 96.55208333333333 120.35492L 96.55208333333333 120.35492z" pathFrom="M 92.35416666666666 120.35492L 92.35416666666666 120.35492L 96.55208333333333 120.35492L 96.55208333333333 120.35492L 96.55208333333333 120.35492L 92.35416666666666 120.35492" cy="100.54968000000001" cx="113.34374999999999" j="4" val="13" barHeight="19.80524" barWidth="4.197916666666666"></path>
                              <path id="SvgjsPath1988" d="M 113.34374999999999 131.01928L 113.34374999999999 90.93479916666668Q 115.44270833333331 88.83584083333335 117.54166666666666 90.93479916666668L 117.54166666666666 90.93479916666668L 117.54166666666666 131.01928L 117.54166666666666 131.01928z" fill="rgba(206,214,249,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="square" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="1" clip-path="url(#gridRectMaskb7bw7j1y)" pathTo="M 113.34374999999999 131.01928L 113.34374999999999 90.93479916666668Q 115.44270833333331 88.83584083333335 117.54166666666666 90.93479916666668L 117.54166666666666 90.93479916666668L 117.54166666666666 131.01928L 117.54166666666666 131.01928z" pathFrom="M 113.34374999999999 131.01928L 113.34374999999999 131.01928L 117.54166666666666 131.01928L 117.54166666666666 131.01928L 117.54166666666666 131.01928L 113.34374999999999 131.01928" cy="89.88532000000001" cx="134.33333333333331" j="5" val="27" barHeight="41.13396" barWidth="4.197916666666666"></path>
                              <g id="SvgjsG1982" class="apexcharts-datalabels" data:realIndex="1"></g>
                           </g>
                           <g id="SvgjsG1989" class="apexcharts-series" seriesName="SeriesxC" rel="3" data:realIndex="2">
                              <path id="SvgjsPath1991" d="M 8.395833333333332 115.78448L 8.395833333333332 49.800839166666655Q 10.494791666666664 47.70188083333332 12.593749999999998 49.800839166666655L 12.593749999999998 49.800839166666655L 12.593749999999998 115.78448L 12.593749999999998 115.78448z" fill="rgba(59,93,231,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="square" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="2" clip-path="url(#gridRectMaskb7bw7j1y)" pathTo="M 8.395833333333332 115.78448L 8.395833333333332 49.800839166666655Q 10.494791666666664 47.70188083333332 12.593749999999998 49.800839166666655L 12.593749999999998 49.800839166666655L 12.593749999999998 115.78448L 12.593749999999998 115.78448z" pathFrom="M 8.395833333333332 115.78448L 8.395833333333332 115.78448L 12.593749999999998 115.78448L 12.593749999999998 115.78448L 12.593749999999998 115.78448L 8.395833333333332 115.78448" cy="48.75135999999999" cx="29.385416666666664" j="0" val="44" barHeight="67.03312000000001" barWidth="4.197916666666666"></path>
                              <path id="SvgjsPath1992" d="M 29.385416666666664 91.40880000000001L 29.385416666666664 8.66687916666667Q 31.484374999999996 6.5679208333333365 33.58333333333333 8.66687916666667L 33.58333333333333 8.66687916666667L 33.58333333333333 91.40880000000001L 33.58333333333333 91.40880000000001z" fill="rgba(59,93,231,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="square" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="2" clip-path="url(#gridRectMaskb7bw7j1y)" pathTo="M 29.385416666666664 91.40880000000001L 29.385416666666664 8.66687916666667Q 31.484374999999996 6.5679208333333365 33.58333333333333 8.66687916666667L 33.58333333333333 8.66687916666667L 33.58333333333333 91.40880000000001L 33.58333333333333 91.40880000000001z" pathFrom="M 29.385416666666664 91.40880000000001L 29.385416666666664 91.40880000000001L 33.58333333333333 91.40880000000001L 33.58333333333333 91.40880000000001L 33.58333333333333 91.40880000000001L 29.385416666666664 91.40880000000001" cy="7.6174000000000035" cx="50.375" j="1" val="55" barHeight="83.79140000000001" barWidth="4.197916666666666"></path>
                              <path id="SvgjsPath1993" d="M 50.375 99.0262L 50.375 37.61299916666666Q 52.473958333333336 35.514040833333326 54.572916666666664 37.61299916666666L 54.572916666666664 37.61299916666666L 54.572916666666664 99.0262L 54.572916666666664 99.0262z" fill="rgba(59,93,231,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="square" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="2" clip-path="url(#gridRectMaskb7bw7j1y)" pathTo="M 50.375 99.0262L 50.375 37.61299916666666Q 52.473958333333336 35.514040833333326 54.572916666666664 37.61299916666666L 54.572916666666664 37.61299916666666L 54.572916666666664 99.0262L 54.572916666666664 99.0262z" pathFrom="M 50.375 99.0262L 50.375 99.0262L 54.572916666666664 99.0262L 54.572916666666664 99.0262L 54.572916666666664 99.0262L 50.375 99.0262" cy="36.56352" cx="71.36458333333333" j="2" val="41" barHeight="62.462680000000006" barWidth="4.197916666666666"></path>
                              <path id="SvgjsPath1994" d="M 71.36458333333333 117.30796000000001L 71.36458333333333 16.28427916666666Q 73.46354166666666 14.185320833333328 75.5625 16.28427916666666L 75.5625 16.28427916666666L 75.5625 117.30796000000001L 75.5625 117.30796000000001z" fill="rgba(59,93,231,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="square" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="2" clip-path="url(#gridRectMaskb7bw7j1y)" pathTo="M 71.36458333333333 117.30796000000001L 71.36458333333333 16.28427916666666Q 73.46354166666666 14.185320833333328 75.5625 16.28427916666666L 75.5625 16.28427916666666L 75.5625 117.30796000000001L 75.5625 117.30796000000001z" pathFrom="M 71.36458333333333 117.30796000000001L 71.36458333333333 117.30796000000001L 75.5625 117.30796000000001L 75.5625 117.30796000000001L 75.5625 117.30796000000001L 71.36458333333333 117.30796000000001" cy="15.234799999999993" cx="92.35416666666666" j="3" val="67" barHeight="102.07316000000002" barWidth="4.197916666666666"></path>
                              <path id="SvgjsPath1995" d="M 92.35416666666666 100.54968000000001L 92.35416666666666 68.08259916666667Q 94.45312499999999 65.98364083333334 96.55208333333333 68.08259916666667L 96.55208333333333 68.08259916666667L 96.55208333333333 100.54968000000001L 96.55208333333333 100.54968000000001z" fill="rgba(59,93,231,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="square" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="2" clip-path="url(#gridRectMaskb7bw7j1y)" pathTo="M 92.35416666666666 100.54968000000001L 92.35416666666666 68.08259916666667Q 94.45312499999999 65.98364083333334 96.55208333333333 68.08259916666667L 96.55208333333333 68.08259916666667L 96.55208333333333 100.54968000000001L 96.55208333333333 100.54968000000001z" pathFrom="M 92.35416666666666 100.54968000000001L 92.35416666666666 100.54968000000001L 96.55208333333333 100.54968000000001L 96.55208333333333 100.54968000000001L 96.55208333333333 100.54968000000001L 92.35416666666666 100.54968000000001" cy="67.03312" cx="113.34374999999999" j="4" val="22" barHeight="33.516560000000005" barWidth="4.197916666666666"></path>
                              <path id="SvgjsPath1996" d="M 113.34374999999999 89.88532000000001L 113.34374999999999 25.42515916666667Q 115.44270833333331 23.32620083333334 117.54166666666666 25.42515916666667L 117.54166666666666 25.42515916666667L 117.54166666666666 89.88532000000001L 117.54166666666666 89.88532000000001z" fill="rgba(59,93,231,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="square" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="2" clip-path="url(#gridRectMaskb7bw7j1y)" pathTo="M 113.34374999999999 89.88532000000001L 113.34374999999999 25.42515916666667Q 115.44270833333331 23.32620083333334 117.54166666666666 25.42515916666667L 117.54166666666666 25.42515916666667L 117.54166666666666 89.88532000000001L 117.54166666666666 89.88532000000001z" pathFrom="M 113.34374999999999 89.88532000000001L 113.34374999999999 89.88532000000001L 117.54166666666666 89.88532000000001L 117.54166666666666 89.88532000000001L 117.54166666666666 89.88532000000001L 113.34374999999999 89.88532000000001" cy="24.375680000000003" cx="134.33333333333331" j="5" val="43" barHeight="65.50964" barWidth="4.197916666666666"></path>
                           </g>
                           <g id="SvgjsG1974" class="apexcharts-datalabels" data:realIndex="0"></g>
                           <g id="SvgjsG1990" class="apexcharts-datalabels" data:realIndex="2"></g>
                        </g>
                        <line id="SvgjsLine2050" x1="0" y1="0" x2="125.9375" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" class="apexcharts-ycrosshairs"></line>
                        <line id="SvgjsLine2051" x1="0" y1="0" x2="125.9375" y2="0" stroke-dasharray="0" stroke-width="0" class="apexcharts-ycrosshairs-hidden"></line>
                        <g id="SvgjsG2052" class="apexcharts-yaxis-annotations"></g>
                        <g id="SvgjsG2053" class="apexcharts-xaxis-annotations"></g>
                        <g id="SvgjsG2054" class="apexcharts-point-annotations"></g>
                     </g>
                     <g id="SvgjsG2018" class="apexcharts-yaxis" rel="0" transform="translate(16.0625, 0)">
                        <g id="SvgjsG2019" class="apexcharts-yaxis-texts-g">
                           <text id="SvgjsText2020" font-family="Helvetica, Arial, sans-serif" x="20" y="41.5" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                              <tspan id="SvgjsTspan2021">100</tspan>
                           </text>
                           <text id="SvgjsText2022" font-family="Helvetica, Arial, sans-serif" x="20" y="71.9696" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                              <tspan id="SvgjsTspan2023">80</tspan>
                           </text>
                           <text id="SvgjsText2024" font-family="Helvetica, Arial, sans-serif" x="20" y="102.4392" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                              <tspan id="SvgjsTspan2025">60</tspan>
                           </text>
                           <text id="SvgjsText2026" font-family="Helvetica, Arial, sans-serif" x="20" y="132.9088" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                              <tspan id="SvgjsTspan2027">40</tspan>
                           </text>
                           <text id="SvgjsText2028" font-family="Helvetica, Arial, sans-serif" x="20" y="163.37840000000003" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                              <tspan id="SvgjsTspan2029">20</tspan>
                           </text>
                           <text id="SvgjsText2030" font-family="Helvetica, Arial, sans-serif" x="20" y="193.84800000000004" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                              <tspan id="SvgjsTspan2031">0</tspan>
                           </text>
                        </g>
                     </g>
                     <g id="SvgjsG1961" class="apexcharts-annotations"></g>
                  </svg>
                  <div class="apexcharts-tooltip apexcharts-theme-light">
                     <div class="apexcharts-tooltip-title" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"></div>
                     <div class="apexcharts-tooltip-series-group">
                        <span class="apexcharts-tooltip-marker" style="background-color: rgb(238, 243, 247);"></span>
                        <div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                           <div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-label"></span><span class="apexcharts-tooltip-text-value"></span></div>
                           <div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div>
                        </div>
                     </div>
                     <div class="apexcharts-tooltip-series-group">
                        <span class="apexcharts-tooltip-marker" style="background-color: rgb(206, 214, 249);"></span>
                        <div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                           <div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-label"></span><span class="apexcharts-tooltip-text-value"></span></div>
                           <div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div>
                        </div>
                     </div>
                     <div class="apexcharts-tooltip-series-group">
                        <span class="apexcharts-tooltip-marker" style="background-color: rgb(59, 93, 231);"></span>
                        <div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                           <div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-label"></span><span class="apexcharts-tooltip-text-value"></span></div>
                           <div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div>
                        </div>
                     </div>
                  </div>
                  <div class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-light">
                     <div class="apexcharts-yaxistooltip-text"></div>
                  </div>
               </div>
            </div>
            <div class="resize-triggers">
               <div class="expand-trigger">
                  <div style="width: 223px; height: 343px;"></div>
               </div>
               <div class="contract-trigger"></div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection


@section('script')
        <!-- plugin js -->
        <script src="{{ URL::asset('libs/apexcharts/apexcharts.min.js')}}"></script>
        
        <!-- jquery.vectormap map -->
        <script src="{{ URL::asset('libs/jquery-vectormap/jquery-vectormap.min.js')}}"></script>
        
        <!-- Calendar init -->
        <script src="{{ URL::asset('js/pages/dashboard.init.js')}}"></script>
@endsection