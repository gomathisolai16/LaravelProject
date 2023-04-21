<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Category::insert([
            [
                'category_id' => null,
                'abbreviation' => null,
                'title' => "All News", //ID 1
                'description' =>null,
                
                'active' => 1
            ],
            [
                'category_id' => 1,
                'abbreviation' => null,
                'title' => "Global Region", //ID 2
                'description' =>null,
                
                'active' => 1
            ],
            [
                'category_id' => 1,
                'abbreviation' => null,
                'title' => "Industry", //ID 3
                'description' =>null,
                
                'active' => 1
            ],
            [
                'category_id' => 1,
                'abbreviation' => null,
                'title' => "Asset Class", //ID 4
                'description' =>null,
                
                'active' => 1
            ],
            [
                'category_id' => 1,
                'abbreviation' => null,
                'title' => "Market Session", //ID 5
                'description' =>null,
                
                'active' => 1
            ],
            [
                'category_id' => 1,
                'abbreviation' => null,
                'title' => "Market Summary", //ID 6
                'description' =>null,
                
                'active' => 1
            ],
            [
                'category_id' => 1,
                'abbreviation' => null,
                'title' => "Sector Summary", //ID 7
                'description' =>null,
                
                'active' => 1
            ],
            [
                'category_id' => 1,
                'abbreviation' => null,
                'title' => "Event News",//ID 8
                'description' =>null,
                
                'active' => 1
            ],
            [
                'category_id' => 1,
                'abbreviation' => null,
                'title' => "Public Company Insiders", //ID 9
                'description' =>null,
                
                'active' => 1
            ],
            [
                'category_id' => 1,
                'abbreviation' => null,
                'title' => "Trading Ideas", //ID 10
                'description' =>null,
                
                'active' => 1
            ],
            [
                'category_id' => 1,
                'abbreviation' => null,
                'title' => "Equities: Price Move", //ID 11
                'description' =>null,
                
                'active' => 1
            ],

            //GLOBAL REGION
            [
                'category_id' => 2,
                'abbreviation' => "USUS.MN",
                'title' => "US",
                'description' =>"Equities, commodities, options, economic events, fixed income and foreign exchange ",
               
                'active' => 1
            ],
            [
                'category_id' => 2,
                'abbreviation' => "CANA.MN",
                'title' => "Canada",
                'description' =>"Equities, commodities, economic events, fixed income and foreign exchange",
               
                'active' => 1
            ],
            [
                'category_id' => 2,
                'abbreviation' => "ALLI.MN",
                'title' => "Global Markets",
                'description' =>"LB PRO Global Markets - service identifier for UK listed, global econ, capital markets, general",
               
                'active' => 1
            ],
            [
                'category_id' => 2,
                'abbreviation' => "AFRI.MN",
                'title' => "Africa",
                'description' =>"Economic events, fixed income and foreign exchange",
               
                'active' => 1
            ],
            [
                'category_id' => 2,
                'abbreviation' => "ASII.MN",
                'title' => "Asia",
                'description' =>"Economic events, fixed income and foreign exchange",
               
                'active' => 1
            ],
            [
                'category_id' => 2,
                'abbreviation' => "AUST.MN",
                'title' => "Australia",
                'description' =>"Economic events, fixed income and foreign exchange",
               
                'active' => 1
            ],

            [
                'category_id' => 2,
                'abbreviation' => "EURR.MN",
                'title' => "Europe",
                'description' =>"Economic events, fixed income and foreign exchange",
               
                'active' => 1
            ],
            [
                'category_id' => 2,
                'abbreviation' => "MEST.MN",
                'title' => "Middle East",
                'description' =>"Economic events, fixed income and foreign exchange",
               
                'active' => 1
            ],

            //INDUSTRY
            [
                'category_id' => 3,
                'abbreviation' => "FINL.MN",
                'title' => "Financials",
                'description' =>"Related to Financial sector and tradable instruments",
               
                'active' => 1
            ],
            [
                'category_id' => 3,
                'abbreviation' => "TNGY.MN",
                'title' => "Technology",
                'description' =>"Related to Technology sector",
               
                'active' => 1
            ],
            [
                'category_id' => 3,
                'abbreviation' => "OILG.MN",
                'title' => "Oil & Gas",
                'description' =>"Related to Oil and Gas sector",
               
                'active' => 1
            ],
            [
                'category_id' => 3,
                'abbreviation' => "HECR.MN",
                'title' => "Healthcare",
                'description' =>"Related to Healthcare",
               
                'active' => 1
            ],
            [
                'category_id' => 3,
                'abbreviation' => "CNGD.MN",
                'title' => "Consumer Goods",
                'description' =>"Related to Consumer Goods",
               
                'active' => 1
            ],
            [
                'category_id' => 3,
                'abbreviation' => "UTIL.MN",
                'title' => "Utilities",
                'description' =>"Related to Utilities",
               
                'active' => 1
            ],
            [
                'category_id' => 3,
                'abbreviation' => "CNSR.MN",
                'title' => "Consumer Services",
                'description' =>"Related to Consumer Products and Services",
               
                'active' => 1
            ],
            [
                'category_id' => 3,
                'abbreviation' => "BASI.MN",
                'title' => "Basic Materials",
                'description' =>"Related to Basic Materials",
               
                'active' => 1
            ],
            [
                'category_id' => 3,
                'abbreviation' => "TELE.MN",
                'title' => "Telecommunications",
                'description' =>"Related to Telecommunications",
               
                'active' => 1
            ],
            [
                'category_id' => 3,
                'abbreviation' => "INDU.MN",
                'title' => "Industrials",
                'description' =>"Related to Industrials",
               
                'active' => 1
            ],
            [
                'category_id' => 3,
                'abbreviation' => "TRAN.MN",
                'title' => "Transportation",
                'description' =>"Related to Transportation",
               
                'active' => 1
            ],

            //ASSET CLASS
            [
                'category_id' => 4 ,
                'abbreviation' => "STOK.MN",
                'title' => "Equities",
                'description' =>"Related to stocks",
               
                'active' => 1
            ],
            [
                'category_id' => 4 ,
                'abbreviation' => "ETFS.MN",
                'title' => "ETFs",
                'description' =>"Related to ETFs",
               
                'active' => 1
            ],
            [
                'category_id' => 4 ,
                'abbreviation' => "COMM.MN",
                'title' => "Commodities",
                'description' =>"Related to commodities",
               
                'active' => 1
            ],
            [
                'category_id' => 4 ,
                'abbreviation' => "BOND.MN",
                'title' => "Bonds",
                'description' =>"Bonds/Fixed Income",
               
                'active' => 1
            ],
            [
                'category_id' => 4 ,
                'abbreviation' => "OPTS.MN",
                'title' => "Options",
                'description' =>"Options commentary (Straddle spreads, Implied Volatility, etc.)",
               
                'active' => 1
            ],
            [
                'category_id' => 4 ,
                'abbreviation' => "FORE.MN",
                'title' => "Forex",
                'description' =>"Forex commentary",
               
                'active' => 1
            ],
            [
                'category_id' => 4 ,
                'abbreviation' => "HFAA.MN",
                'title' => "Alternatives",
                'description' =>"Significant buy side conferences and event coverage ",
               
                'active' => 1
            ],

            //Market session
            [
                'category_id' => 5 ,
                'abbreviation' => "PMKT.MN",
                'title' => "Pre-Market",
                'description' =>"Time of day filter",
               
                'active' => 1
            ],
            [
                'category_id' => 5 ,
                'abbreviation' => "EXTND.MN",
                'title' => "Extended-Hours",
                'description' =>"Time of day filter which combines \"PMKT.MN\" and \"AFTRH.MN\"",
               
                'active' => 1
            ],
            [
                'category_id' => 5 ,
                'abbreviation' => "AFTRH.MN",
                'title' => "After-Hours",
                'description' =>"Time of day filter",
               
                'active' => 1
            ],
            //MARKET SUMMARY
            [
                'category_id' => 6 ,
                'abbreviation' => "EQUI.MN",
                'title' => "Equities",
                'description' =>"Broad equity market summary",
               
                'active' => 1
            ],
            [
                'category_id' => 6 ,
                'abbreviation' => "SETF.MN",
                'title' => "ETF",
                'description' =>"Broad equity market summary",
               
                'active' => 1
            ],
            [
                'category_id' => 6 ,
                'abbreviation' => "PMMS.MN",
                'title' => "Pre-Market",
                'description' =>"Broad equity market summary",
               
                'active' => 1
            ],
            [
                'category_id' => 6 ,
                'abbreviation' => "TCHBO.MN",
                'title' => "Mid-Day",
                'description' =>"Broad equity market summary",
               
                'active' => 1
            ],
            [
                'category_id' => 6 ,
                'abbreviation' => "AHMS.MN",
                'title' => "Closing",
                'description' =>"Broad equity market summary",
               
                'active' => 1
            ],
            [
                'category_id' => 6 ,
                'abbreviation' => "FUTR.MN",
                'title' => "Futures",
                'description' =>"Broad equity market summary",
               
                'active' => 1
            ],
            [
                'category_id' => 6 ,
                'abbreviation' => "GMMS.MN",
                'title' => "Global (non-US)",
                'description' =>"Broad equity market summary",
               
                'active' => 1
            ],
            //GLOBAL NON US ID : 47
            [
                'category_id' => 47 ,
                'abbreviation' => "GMCA.MN",
                'title' => "Canada",
                'description' =>"Broad Canadian equity market summary",
               
                'active' => 1
            ],
            [
                'category_id' => 47,
                'abbreviation' => "GMEU.MN",
                'title' => "Europe",
                'description' =>"Broad European equity market summary",
               
                'active' => 1
            ],
            [
                'category_id' => 47,
                'abbreviation' => "GMAS.MN",
                'title' => "Asia",
                'description' =>"Broad Asian equity market summary",
               
                'active' => 1
            ],
            [
                'category_id' => 47,
                'abbreviation' => "GMME.MN",
                'title' => "Middle East",
                'description' =>"Broad Middle Eastern equity market summary",
               
                'active' => 1
            ],
            [
                'category_id' => 47,
                'abbreviation' => "GMLA.MN",
                'title' => "Latin America",
                'description' =>"Broad Latin American equity market summary",
               
                'active' => 1
            ],
            [
                'category_id' => 6 ,
                'abbreviation' => "ADRB.MN",
                'title' => "Broad ADR Suymmary",
                'description' =>"Broad equity market summary",
               
                'active' => 1
            ],
            [
                'category_id' => 6 ,
                'abbreviation' => "ADRA.MN",
                'title' => "Asian ADR Summary",
                'description' =>"Broad equity market summary",
               
                'active' => 1
            ],
            [
                'category_id' => 6 ,
                'abbreviation' => "ADRE.MN",
                'title' => "European ADR Summary",
                'description' =>"Broad equity market summary",
               
                'active' => 1
            ],
            [
                'category_id' => 6 ,
                'abbreviation' => "ADRL.MN",
                'title' => "Latin America ADR Summary",
                'description' =>"Summary of Latin American companies trading as ADRs - Occasional",
               
                'active' => 1
            ],
            [
                'category_id' => 6 ,
                'abbreviation' => "WRAP.MN",
                'title' => "Weekly Wrap",
                'description' =>"Weekly market wrap - Issued by 4:30 pm EST Fridays",
               
                'active' => 1
            ],
            [
                'category_id' => 6 ,
                'abbreviation' => "MOST.MN",
                'title' => "Most Active",
                'description' =>"Broad equity market summary",
               
                'active' => 1
            ],
            // SECTOR SUMMARY
            [
                'category_id' => 7,
                'abbreviation' => "ENEG.MN",
                'title' => "Energy",
                'description' =>"Energy sector summary",
               
                'active' => 1
            ],
            [
                'category_id' => 7,
                'abbreviation' => "FINA.MN",
                'title' => "Financial",
                'description' =>"Energy sector summary",
               
                'active' => 1
            ],
            [
                'category_id' => 7,
                'abbreviation' => "CONS.MN",
                'title' => "Consumer",
                'description' =>"Energy sector summary",
               
                'active' => 1
            ],
            [
                'category_id' => 7,
                'abbreviation' => "TECH.MN",
                'title' => "Tech",
                'description' =>"Energy sector summary",
               
                'active' => 1
            ],
            [
                'category_id' => 7,
                'abbreviation' => "HEAL.MN",
                'title' => "Healthcare",
                'description' =>"Energy sector summary",
               
                'active' => 1
            ],
            [
                'category_id' => 7,
                'abbreviation' => "DSPM.MN",
                'title' => "Pre-Market",
                'description' =>"Energy sector summary",
               
                'active' => 1
            ],
            [
                'category_id' => 7,
                'abbreviation' => "DSMD.MN",
                'title' => "Mid-Day",
                'description' =>"Energy sector summary",
               
                'active' => 1
            ],
            [
                'category_id' => 7,
                'abbreviation' => "DSCL.MN",
                'title' => "Closing",
                'description' =>"Energy sector summary",
               
                'active' => 1
            ],
            [
                'category_id' => 7,
                'abbreviation' => "GOME.MN",
                'title' => "Gold and Metals",
                'description' =>"Energy sector summary",
               
                'active' => 1
            ],
            [
                'category_id' => 7,
                'abbreviation' => "OIL.MN",
                'title' => "Oil",
                'description' =>"Energy sector summary",
               
                'active' => 1
            ],
            [
                'category_id' => 7,
                'abbreviation' => "NAT.MN",
                'title' => "Natural Gas",
                'description' =>"Energy sector summary",
               
                'active' => 1
            ],
            [
                'category_id' => 7,
                'abbreviation' => "MANU.MN",
                'title' => "Manufacturing",
                'description' =>"Energy sector summary",
               
                'active' => 1
            ],
            [
                'category_id' => 7,
                'abbreviation' => "MINE.MN",
                'title' => "Mining",
                'description' =>"Energy sector summary",
               
                'active' => 1
            ],
            // EVENT NEWS
            [
                'category_id' => 8,
                'abbreviation' => "TOPN.MN",
                'title' => "TOP NEWS",
                'description' =>"Top corporate, econ & market stories of the day (Optional: Top News Image Service)",
               
                'active' => 1
            ],
            [
                'category_id' => 8,
                'abbreviation' => "ANACT.MN",
                'title' => "Analyst Rating Change",
                'description' =>"Top corporate, econ & market stories of the day (Optional: Top News Image Service)",
               
                'active' => 1
            ],
            //TODO ANALYST RATING CHANGE ID: 73
            [
                'category_id' => 73,
                'abbreviation' => "ANACU.MN",
                'title' => "Upgrade",
                'description' =>"Analyst upgrade",
               
                'active' => 1
            ],
            [
                'category_id' => 73,
                'abbreviation' => "ANACD.MN",
                'title' => "Downgrade",
                'description' =>"Analyst downgrade",
               
                'active' => 1
            ],
            [
                'category_id' => 73,
                'abbreviation' => "ANACI.MN",
                'title' => "Initiate",
                'description' =>"Analyst initiates coverage",
               
                'active' => 1
            ],
            [
                'category_id' => 73,
                'abbreviation' => "ANARE.MN",
                'title' => "Reiterated",
                'description' =>"Analyst reiterates coverage",
               
                'active' => 1
            ],
            [
                'category_id' => 8,
                'abbreviation' => "ECON.MN",
                'title' => "Economic Briefs",
                'description' =>"Top corporate, econ & market stories of the day (Optional: Top News Image Service)",
               
                'active' => 1
            ],
            [
                'category_id' => 8,
                'abbreviation' => "EARN.MN",
                'title' => "Earnings",
                'description' =>"Top corporate, econ & market stories of the day (Optional: Top News Image Service)",
               
                'active' => 1
            ],
            //TODO EARNINGS ID: 79
            [
                'category_id' => 79,
                'abbreviation' => "EARNW.MN",
                'title' => "Warnings",
                'description' =>"Corporate earnings warning",
               
                'active' => 1
            ],
            [
                'category_id' => 79,
                'abbreviation' => "EARNR.MN",
                'title' => "Revision",
                'description' =>"Corporate earnings revision announcement",
               
                'active' => 1
            ],
            [
                'category_id' => 79,
                'abbreviation' => "CONFC.MN",
                'title' => "Conf. Call Highlights",
                'description' =>"Earnings conference call notes",
               
                'active' => 1
            ],
            [
                'category_id' => 79,
                'abbreviation' => "ECTR.MN",
                'title' => "Conf. Call Transcript",
                'description' =>"URL to full text transcript of earnings conference call",
               
                'active' => 1
            ],
            [
                'category_id' => 79,
                'abbreviation' => "EPSF.MN",
                'title' => "EPS (Flash)",
                'description' =>"Low latency EPS actuals with surprise % (vs. consensus)",
               
                'active' => 1
            ],
            [
                'category_id' => 79,
                'abbreviation' => "REVF.MN",
                'title' => "Revenues (Flash)",
                'description' =>"Low latency Revenue actuals with surprise % (vs. consensus)",
               
                'active' => 1
            ],
            [
                'category_id' => 79,
                'abbreviation' => "GUIF.MN",
                'title' => "Guidance (Flash)",
                'description' =>"Low latency quarterly or annual guidance reported (EPS, Revenues)",
               
                'active' => 1
            ],
            [
                'category_id' => 8,
                'abbreviation' => "EQDE.MN",
                'title' => "Equity / Debt Offering",
                'description' =>"Top corporate, econ & market stories of the day (Optional: Top News Image Service)",
               
                'active' => 1
            ],
            [
                'category_id' => 8,
                'abbreviation' => "CLEV.MN",
                'title' => "C-Level Changes",
                'description' =>"Top corporate, econ & market stories of the day (Optional: Top News Image Service)",
               
                'active' => 1
            ],
            [
                'category_id' => 8,
                'abbreviation' => "MERGA.MN",
                'title' => "Mergers & Acquisitions",
                'description' =>"Top corporate, econ & market stories of the day (Optional: Top News Image Service)",
               
                'active' => 1
            ],
            [
                'category_id' => 8,
                'abbreviation' => "BIDA.MN",
                'title' => "Bid",
                'description' =>"Top corporate, econ & market stories of the day (Optional: Top News Image Service)",
               
                'active' => 1
            ],
            [
                'category_id' => 8,
                'abbreviation' => "ASKA.MN",
                'title' => "Ask",
                'description' =>"Top corporate, econ & market stories of the day (Optional: Top News Image Service)",
               
                'active' => 1
            ],
            [
                'category_id' => 8,
                'abbreviation' => "NEWSL.MN",
                'title' => "New sale",
                'description' =>"Top corporate, econ & market stories of the day (Optional: Top News Image Service)",
               
                'active' => 1
            ],
            [
                'category_id' => 8,
                'abbreviation' => "NEWPR.MN",
                'title' => "New Product",
                'description' =>"Top corporate, econ & market stories of the day (Optional: Top News Image Service)",
               
                'active' => 1
            ],
            [
                'category_id' => 8,
                'abbreviation' => "WL52.MN",
                'title' => "52 Week Low",
                'description' =>"Top corporate, econ & market stories of the day (Optional: Top News Image Service)",
               
                'active' => 1
            ],
            [
                'category_id' => 8,
                'abbreviation' => "WH52.MN",
                'title' => "52 Week High",
                'description' =>"Top corporate, econ & market stories of the day (Optional: Top News Image Service)",
               
                'active' => 1
            ],
            [
                'category_id' => 8,
                'abbreviation' => "DVDS.MN",
                'title' => "Dividends",
                'description' =>"Top corporate, econ & market stories of the day (Optional: Top News Image Service)",
               
                'active' => 1
            ],
            [
                'category_id' => 8,
                'abbreviation' => "IPON.MN",
                'title' => "IPO News",
                'description' =>"Top corporate, econ & market stories of the day (Optional: Top News Image Service)",
               
                'active' => 1
            ],
            [
                'category_id' => 8,
                'abbreviation' => "HALTS.MN",
                'title' => "Trading Halts",
                'description' =>"Top corporate, econ & market stories of the day (Optional: Top News Image Service)",
               
                'active' => 1
            ],
            [
                'category_id' => 8,
                'abbreviation' => "OPME.MN",
                'title' => "Operating Metrics",
                'description' =>"Top corporate, econ & market stories of the day (Optional: Top News Image Service)",
               
                'active' => 1
            ],
            [
                'category_id' => 8,
                'abbreviation' => "REGM.MN",
                'title' => "Regulatory Action",
                'description' =>"Top corporate, econ & market stories of the day (Optional: Top News Image Service)",
               
                'active' => 1
            ],
            [
                'category_id' => 8,
                'abbreviation' => "STREE.MN",
                'title' => "Street Color - Bloomberg",
                'description' =>"Ask Alyce Chat service derived intel (dealers, hedge funds, prop desks, traders, economists, etc.)",
               
                'active' => 1
            ],
            [
                'category_id' => 8,
                'abbreviation' => "FOCH.MN",
                'title' => "Street Color - ICE",
                'description' =>"First Oil Chat service intel from ICE Instant Message (oil market particiants globally)",
               
                'active' => 1
            ],
            [
                'category_id' => 8,
                'abbreviation' => "SBUY.MN",
                'title' => "Stock Buyback",
                'description' =>"Top corporate, econ & market stories of the day (Optional: Top News Image Service)",
               
                'active' => 1
            ],
            [
                'category_id' => 8,
                'abbreviation' => "NONW.MN",
                'title' => "No Apparent News",
                'description' =>"Top corporate, econ & market stories of the day (Optional: Top News Image Service)",
               
                'active' => 1
            ],
            [
                'category_id' => 8,
                'abbreviation' => "LEGL.MN",
                'title' => "Legal Action",
                'description' =>"Top corporate, econ & market stories of the day (Optional: Top News Image Service)",
               
                'active' => 1
            ],
            //Public Company Insiders
            [
                'category_id' => 9,
                'abbreviation' => "AOSH.MN",
                'title' => "Insider Trends (IT): Award",
                'description' =>"Awards of shares (including options), net add to position",
               
                'active' => 1
            ],
            [
                'category_id' => 9,
                'abbreviation' => "SALE.MN",
                'title' => "IT: Sale",
                'description' =>"Awards of shares (including options), net add to position",
               
                'active' => 1
            ],
            [
                'category_id' => 9,
                'abbreviation' => "ASHT.MN",
                'title' => "IT: Sale for Taxes",
                'description' =>"Awards of shares (including options), net add to position",
               
                'active' => 1
            ],
            [
                'category_id' => 9,
                'abbreviation' => "TAXS.MN",
                'title' => "IT: Forced Tax Sale",
                'description' =>"Awards of shares (including options), net add to position",
               
                'active' => 1
            ],
            [
                'category_id' => 9,
                'abbreviation' => "EOPS.MN",
                'title' => "IT: Options Excercise and Sale",
                'description' =>"Awards of shares (including options), net add to position",
               
                'active' => 1
            ],
            [
                'category_id' => 9,
                'abbreviation' => "PURS.MN",
                'title' => "IT: Buy",
                'description' =>"Awards of shares (including options), net add to position",
               
                'active' => 1
            ],
            [
                'category_id' => 9,
                'abbreviation' => "EOPT.MN",
                'title' => "IT: Options Exercise, Tax Sale",
                'description' =>"Awards of shares (including options), net add to position",
               
                'active' => 1
            ],
            [
                'category_id' => 9,
                'abbreviation' => "CONV.MN ",
                'title' => "IT:  Stock Conversion",
                'description' =>"Awards of shares (including options), net add to position",
               
                'active' => 1
            ],
            [
                'category_id' => 9,
                'abbreviation' => "SITA.MN",
                'title' => "IT:  Unusual Insider Acivity",
                'description' =>"Awards of shares (including options), net add to position",
               
                'active' => 1
            ],
            //Trading Ideas
            [
                'category_id' => 10,
                'abbreviation' => "BAIL.MN",
                'title' => "Market Chatter",
                'description' =>"Real time coverage of trading desk rumors and breaking news",
               
                'active' => 1
            ],
            [
                'category_id' => 10,
                'abbreviation' => "MTF1.MN",
                'title' => "MT Insider",
                'description' =>"Real time coverage of trading desk rumors and breaking news",
               
                'active' => 1
            ],
            [
                'category_id' => 10,
                'abbreviation' => "ERNB.MN",
                'title' => "Earnings Notebook",
                'description' =>"Real time coverage of trading desk rumors and breaking news",
               
                'active' => 1
            ],
            [
                'category_id' => 10,
                'abbreviation' => "ITMF.MN",
                'title' => "Forecast Report",
                'description' =>"Real time coverage of trading desk rumors and breaking news",
               
                'active' => 1
            ],
            [
                'category_id' => 10,
                'abbreviation' => "FCUD.MN",
                'title' => "Forecast Report Updates",
                'description' =>"Real time coverage of trading desk rumors and breaking news",
               
                'active' => 1
            ],
            [
                'category_id' => 10,
                'abbreviation' => "OPEN.MN",
                'title' => "Opening Bell Momentum",
                'description' =>"Real time coverage of trading desk rumors and breaking news",
               
                'active' => 1
            ],
            [
                'category_id' => 10,
                'abbreviation' => "TRAD.MN",
                'title' => "Trading Range Analysis",
                'description' =>"Real time coverage of trading desk rumors and breaking news",
               
                'active' => 1
            ],
            [
                'category_id' => 10,
                'abbreviation' => "ANMN.MN",
                'title' => "Analyst Notebook",
                'description' =>"Real time coverage of trading desk rumors and breaking news",
               
                'active' => 1
            ],
            [
                'category_id' => 10,
                'abbreviation' => "WATC.MN",
                'title' => "Watch List Reports",
                'description' =>"Real time coverage of trading desk rumors and breaking news",
               
                'active' => 1
            ],
            //Equities: Price Move
            [
                'category_id' => 11,
                'abbreviation' => "GAIN.MN",
                'title' => "Stock Price Up",
                'description' =>"Stock price up relative to prior 4 pm EST close",
               
                'active' => 1
            ],
            [
                'category_id' => 11,
                'abbreviation' => "LOSE.MN",
                'title' => "Stock Price Down",
                'description' =>"Stock price down relative to prior 4 pm EST close",
               
                'active' => 1
            ],

        ]);

    }
}
