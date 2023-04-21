<?php

use Illuminate\Database\Seeder;

class NewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        $insertNewCategory = [];
        $insertUserNewParked = [];

        for ($i = 0; $i < 50; $i++) {
            $insertNewCategory[] = [
                'new_id' => rand(1, 100),
                'category_id' => rand(1, 50)
            ];
            $insertUserNewParked[] = [
                'user_id' => rand(1, 50),
                'new_id' => rand(1, 100)
            ];
        }

        \DB::table('new_category')->insert($insertNewCategory);
        \DB::table('user_new_parked')->insert($insertUserNewParked);
        */

        $date = \Carbon\Carbon::now()->toDateTimeString();


        \App\Models\News::insert([
            [
                'title' => "Apple launches Apple Music in China",
                'percentage' => 2,
                'description' => 'Apple Inc launched Apple Music along with iTunes Movies and iBooks in China and said the cloud-based music streaming service will roll out on Android phones this fall.

Apple will offer Apple Music subscribers access to a vast library of songs for 10 yuan ($1.57) a month after an initial three-month trial membership, the company said in a statement.

The announcement comes at a time when the iPhone maker has been struggling to reassure its shareholders about its business in China.

Chinese consumers are critical to fueling demand for iPhones, and a slump in the country\'s stock market and Beijing\'s recent devaluation of the yuan have shaken Apple investors already worried about slowing growth in the world\'s No. 2 economy.

Apple Music in China will feature local artists such as Eason Chan, Li Ronghao, JJ Lin and G.E.M., along with a range of international artists, the company said.

Subscribers would also be able to rent or buy movies from a selection of Chinese studios as well as Hollywood blockbusters on the iTunes Store, Apple said.',
                'top' => 0,
                'active' => 1,
                'created_at'=> $date,
                'updated_at'=> $date,
            ],
            [
                'title' => "Big companies go anti-Trump",
                'percentage' => null,
                'description' => 'May 21 Russia\'s No.4 crude producer Surgutneftegas will increase its dividends for 2011 to 2.15 roubles per preferred share and 0.6 rouble per ordinary share, the company said late last week.

Surgutneftegas\' net profit rose 81 percent year-on-year to 233.2 billion roubles last year.

For 2010, the company paid dividends of 1.18 roubles per preferred share and 0.5 roubles per ordinary share.

(Reporting by Denis Pinchuk; Writing by Katya Golubkova; Editing by Edwina Gibbs)',
                'top' => 1,
                'active' => 1,
                'created_at'=> $date,
                'updated_at'=> $date,
            ],
            [
                'title' => "Conwert proposes 10 cent dividend",
                'percentage' => -2,
                'description' => 'Austrian property group Conwert proposed paying a 10 cent per share dividend on 2013 results, half of what it had said last March was likely.

"In light of the group profit a dividend of 0.10 euro per share will be proposed to shareholders at the next ordinary annual general meeting on May 7, 2014. This translates into 8.3 million euros ($11.44 million) based on the current number of shares outstanding," it said in a statement late on Tuesday.

The company had said last March it should be able to pay at least 0.20 euros per share for 2013.

($1 = 0.7258 Euros) (Reporting by Michael Shields, Editing by Angelika Gruber)',
                'top' => 0,
                'active' => 1,
                'created_at'=> $date,
                'updated_at'=> $date,
            ],
            [
                'title' => "Google, Apple, and Microsoft stocks were all priced $123.47 in one very weird moment Monday",
                'percentage' => null,
                'description' => 'For one moment on Monday afternoon, the prices of several stocks on Nasdaq — including those of Amazon, Apple, eBay, Google, and Microsoft — were all priced exactly the same, $123.47.

Obviously, this couldn\'t be correct; it would mean a sudden, massive drop in value for Amazon and Google and a huge increase in value for Microsoft and eBay. If it were true, Google\'s market cap would fall from $623 billion to about $83 billion, while Microsoft\'s market cap would be propelled to nearly $1 trillion. 


The odd occurrence was caused by a data glitch, the Financial Times reported late Monday, that affected only some of the stocks listed on Nasdaq. While the stock prices remained unaltered on Nasdaq itself, third-party services such as Google Finance and Bloomberg displayed the erroneous $123.47 price for a while.  ',
                'top' => 0,
                'active' => 1,
                'created_at'=> $date,
                'updated_at'=> $date,
            ],
            [
                'title' => "Samsung salvages Galaxy Note 7 parts for new phone",
                'percentage' => 30,
                'description' => 'Samsung is releasing a new phone using parts from its Galaxy Note 7, which was axed after a battery fault led to some devices catching fire.
The firm said the Note Fan Edition would "minimise the environmental impact" of its high-profile flop.
The handset will go on sale only in South Korea on 7 July, with a safer, smaller battery, the firm added.
Samsung stopped production on its iPhone rival late last year after an earlier botched recall and re-release.
About 2.5 million handsets have since been recalled. The new phone features components from those recalled devices, as well as unused parts Samsung has in stock.
Smaller battery, smaller price tag
Environmentalists had been putting pressure on the firm to reuse Galaxy Note 7 components to reduce the amount of so-called e-waste.
It is thought about 400,000 handsets will be made available from Friday. It will be priced about 30% cheaper than the Galaxy Note 7 at around 700,000 Korean won ($615; £472).
The devices will be fitted with 3,200 mAh batteries that Samsung says have passed strict safety tests. The Note 7 used 3,500 mAh batteries.
The Samsung Galaxy Note 8, the successor to the original Note 7, is due for release later this year.',
                'top' => 0,
                'active' => 1,
                'created_at'=> $date,
                'updated_at'=> $date,
            ],
            [
                'title' => "Oil eases on U.S. holiday after eight days of gains",
                'percentage' => -0.12,
                'description' => 'Oil prices fell on Tuesday, as investors booked profits on an eight-day rally that was triggered by tentative signs that a persistent rise in U.S. crude production may be slowing.

Brent crude futures LCOc1 fell by 15 cents to $49.53 per barrel by 1138 GMT.

U.S. West Texas Intermediate (WTI) crude futures CLc1 were trading down 12 cents at $46.95 a barrel.

The falls came after both benchmarks recovered around 12 percent from their recent lows on June 21.

Many traders closed positions ahead of the U.S. Independence Day holiday on July 4, while Brent also faced technical resistance as it approached $50 per barrel, traders said.

Despite this, the market\'s outlook has shifted somewhat.

Late May and most of June were overwhelmingly bearish as U.S. output rose and doubts grew over the ability of the Organization of the Petroleum Exporting Countries (OPEC) to hold back enough production to tighten the market.

But sentiment began to shift toward the end of June, when U.S. data showed a dip in American oil output and a slight fall in drilling for new production. RIG-OL-USA-BHI C-OUT-T-EIA

"The fact that prices have not come under any noticeable pressure of late points to a shift in sentiment," Commerzbank said on Tuesday.

"This may be related to the fact that most of the \'shaky hands\' have withdrawn from the market by now," the bank added.

Prices rose in recent days despite OPEC production hitting a 2017 high of 32.72 million barrels a day in June, according to a Reuters survey.

The group\'s efforts to rebalance the market have been undermined by rising production from Libya and Nigeria, who are exempt from the cuts.',
                'top' => 1,
                'active' => 1,
                'created_at'=> $date,
                'updated_at'=> $date,
            ],
            [
                'title' => "Trump to promote U.S. natgas exports in Russia's backyard",
                'percentage' => null,
                'description' => 'President Donald Trump will use fast-growing supplies of U.S. natural gas as a political tool when he meets in Warsaw on Thursday with leaders of a dozen countries that are captive to Russia for their energy needs.

In recent years, Moscow has cut off gas shipments during pricing disputes with neighboring countries in winter months. Exports from the United States would help reduce their dependence on Russia.

Trump will tell the group that Washington wants to help allies by making it as easy as possible for U.S. companies to ship more liquefied natural gas (LNG) to central and eastern Europe, the White House said.

Trump will attend the "Three Seas" summit - so named because several of its members surround the Adriatic, Baltic and Black Seas - before the Group of 20 leading economies meet in Germany, where he is slated to meet Russian President Vladimir Putin for the first time.

Among the aims of the Three Seas project is to expand regional energy infrastructure, including LNG import terminals and gas pipelines. Members of the initiative include Poland, Austria, Hungary and Russia\'s neighbors Latvia and Estonia.

Trump\'s presence will give the project a lift, said James Jones, a former NATO Supreme Allied Commander.

Increased U.S. gas exports to the region would help weaken the impact of Russia using energy as a weapon or bargaining chip, said Jones.

"I think the United States can show itself as a benevolent country by exporting energy and by helping countries that don’t have adequate supplies become more self-sufficient and less dependent and less threatened," he said.

Trump\'s Russia policy is still taking shape, a process made awkward by investigations into intelligence findings that Russia tried to meddle in the 2016 U.S. presidential race. Russia denies the allegations and Trump says his team did not collude with Moscow.

Lawmakers in Trump\'s Republican Party, many of whom want to see him take a hard line on Russia because of its interference in the election and in crises in Ukraine and Syria, support using gas exports for political leverage.

"It undermines the strategies of Putin and other strong men who are trying to use the light switch as an element of strategic offense," said Senator Cory Gardner, a Republican from Colorado who is on the Senate Foreign Relations Committee.

The Kremlin relies on oil and gas revenue to finance the state budget, so taking market share would hurt Moscow.

"In many ways, the LNG exports by the U.S. is the most threatening U.S. policy to Russia," said Michal Baranowski, director of the Warsaw office of think-tank the German Marshall Fund.
COMPETITIVE ARENA

The U.S. is expected to become the world\'s third-largest exporter of LNG in 2020, just four years after starting up its first export terminal. U.S. exporters have sold most of that gas in long-term contracts, but there are still some volumes on offer, and more export projects on the drawing board.

Cheniere Energy Inc (LNG.A), which opened the first U.S. LNG export terminal in 2016, delivered its first cargo to Poland in June. Five more terminals are expected to be online by 2020.

Tellurian Inc (TELL.O) has proposed a project with a price tag of as much as $16 billion that it hopes to complete by 2022, in time to compete for long-term contracts to supply Poland that expire the same year and are held by Russian gas giant Gazprom (GAZP.MM).

"We would like to be a supplier that competes for that market," Tellurian Chief Executive Meg Gentle told Reuters.

A global glut in supply may, however, limit U.S. LNG export growth, regardless of Trump\'s support.',
                'top' => 0,
                'active' => 1,
                'created_at'=> $date,
                'updated_at'=> $date,
            ],
            [
                'title' => "Samsung plans $18.6 billion South Korea investment to widen chip lead",
                'percentage' => null,
                'description' => 'Samsung Electronics Co Ltd (005930.KS) said on Tuesday it will invest at least $18.6 billion in South Korea to extend its lead in memory chips and next-generation smartphone displays, in a plan that promises to create almost half a million jobs.

The investment underscores Samsung\'s determination to widen its lead in memory chips, which are expected to propel Asia\'s third most-valuable company to record profit this year. It routinely invests more than $10 billion in chips annually, helping it stay ahead of competitors such as cross-town rival SK Hynix Inc (000660.KS) and Japan\'s Toshiba Corp (6502.T).

The announcement follows repeated calls from new South Korean President Moon Jae-in for big businesses to invest more domestically as part of a wider job-creation agenda. Samsung said its plan could open up to 440,000 roles by 2021.

The huge investment is also likely to alleviate shareholder fears of major decisions being delayed in the absence of Vice Chairman Jay Y. Lee. The leader of Samsung Group [SAGR.UL] is on trial charged with bribing former president Park Geun-hye for political favors.

"Samsung is being more aggressive in domestic investments because of the current (political) climate," said Park Ju-gun, head of corporate analysis firm CEO Score.

The firm also needs to show initiative domestically after announcing a $380 million plant in the United States, Park said.

SUPPLY SHORTAGE

Memory makers are widely expected to post record profits in 2017 as prices rise in response to demand for more features in smartphones and servers, as well as a persistent supply shortage which analysts and industry sources said is more acute for NAND chips due to increasing adoption of high-end storage products.

Samsung, SK Hynix and Toshiba have committed billions of dollars to boost NAND output in recent years, yet shortages are expected to persist at least through 2017 as new facilities will not make meaningful supply contributions until next year.

Under its latest spending plan, Samsung will put 14.4 trillion won into its new NAND factory in Pyeongtaek by 2021. It will invest 6 trillion won in a new semiconductor production line in Hwaseong, but did not elaborate on timing or product.

Some analysts said additional capacity across the industry could cause slight oversupply in early 2018, but that prices are unlikely to drop because demand is so strong.

"There\'s no chance of major oversupply issues, and I think Samsung is investing so much because it\'s convinced that won\'t happen," said Shinhan Investment analyst Choi Do-yeon.

CHIPS IN CHINA

Samsung also said it will add a production line to its NAND plant in Xi\'an, China, though it has not yet set an investment amount or time frame.',
                'top' => 0,
                'active' => 1,
                'created_at'=> $date,
                'updated_at'=> $date,
            ],
            [
                'title' => "Glitch causes prices of Apple, Google, other stocks to appear off",
                'percentage' => null,
                'description' => 'The prices of several big-name Nasdaq-listed (NDAQ.O) stocks appeared on some websites to either spike or plummet well after the closing bell on Monday, seemingly due to a glitch related to the market data that runs the largely automated markets.

At around 6:30 p.m., the prices of Amazon Inc (AMZN.O) and Microsoft Corp (MSFT.O) stocks appeared to have lost more than half their value, while Apple Inc (AAPL.O) shares appeared to more than double. Google parent Alphabet Inc (GOOGL.O) and eBay Inc (EBAY.O) shares were among others that all appeared to be priced at $123.47 on some financial news websites on Monday evening.

The actual prices of the stocks were not affected and no trades were completed at that price, a Nasdaq spokesman confirmed.

Nasdaq said in a statement it was investigating the improper use of test data distributed by third parties. Prices on Nasdaq\'s website were not affected.

Nasdaq and other U.S. stock exchanges closed early on Monday ahead of the U.S. Independence Day holiday on Tuesday.

Testing of stock exchange software is mandated by the U.S. Securities and Exchange Commission and happens on a regular basis to help prevent electronic glitches, often using test symbols and historical data.

(Reporting by John McCrank; Editing by Shri Navaratnam)',
                'top' => 0,
                'active' => 1,
                'created_at'=> $date,
                'updated_at'=> $date,
            ],
            [
                'title' => "Corvex, NYC investment group seek to scuttle Clariant-Huntsman deal",
                'percentage' => null,
                'description' => 'Activist investor Keith Meister\'s Corvex hedge fund and New York\'s 40 North said on Tuesday they had taken a 7.2 percent stake in Clariant (CLN.S) to fight the Swiss chemical maker\'s planned merger with Huntsman Corp (HUN.N).

"There are excellent opportunities to unlock value from the many high quality businesses that currently comprise Clariant," a spokesman for White Tale, the vehicle they created to buy the stake, said.

"Unfortunately, we do not believe that the proposed merger with the Huntsman Corporation is one of those options."

Meister, a Carl Icahn protege, with Corvex manages assets worth $6 billion and took a 5.5 percent stake in communications company Century Inc (CTL.N) earlier this year.

40 North, run by New York real estate investor David Winter and former Bear, Stearns & Company financial analyst David Millstone, held a stake in Clariant before linking with Corvex in their bid to overturn the Huntsman deal. Winter and Millstone are also co-CEOs of roofing maker Standard Industries.

Their gambit is the latest by a U.S.-based activist investor to make waves in Europe, with billionaire investor Daniel Loeb\'s Third Point late last month taking a $3.5 billion stake in Nestle (NESN.S) in a bid to get the Swiss food giant to boost performance and repurchase shares. Nestle subsequently announced a nearly $21 billion share buyback.

Clariant, which on Tuesday noted the increased investment by Corvex without addressing Corvex\'s opposition to the merger, said it has been in contact with the hedge fund since last year when it initially took a stake.

"As with all our shareholders we maintain an open dialogue with them," a Clariant spokesman said.

Huntsman did not return a phone call seeking immediate comment.

Both shares rose after the news, with Clariant up 3.4 percent and Huntsman up 1.63 percent as of 1000 GMT.

Clariant and Huntsman in May announced a merger valued at around $20 billion including debt in which Clariant shareholders would hold 52 percent of the combination.

At the time, they talked up the friendship between chief executives Hariolf Kottmann and Peter Huntsman as well as prospects for faster growth for the combined company as rationale for "a merger of equals". Among other things, they expect about $400 million in annual cost synergies.

The deal, creating a company with about $13 billion in annual sales, had support of German families that own almost 14 percent of Clariant.

Some analysts said the transaction makes sense, in particular after Huntsman spins off its Venator pigments business in an IPO.

"Huntsman’s portfolio, after the pending Venator spin-off, offers a highly complementary growth portfolio, in our view - complementary in a way that it puts both companies on a sounder, broader footing," Kepler Cheuvreux\'s Christian Faitz said.',
                'top' => 1,
                'active' => 1,
                'created_at'=> $date,
                'updated_at'=> $date,
            ],
            [
                'title' => "Tesla deliveries at low end of forecast, starting Model 3 production",
                'percentage' => 2.56,
                'description' => 'Tesla Inc said it delivered about 47,100 electric sedans and SUVs in the first half of 2017, at the lower end of its own forecasts, shortly after Chief Executive Elon Musk announced that production of its mass-market Model 3 would start this week and build to 20,000 per month in December.

Shares fell 2.5 percent in regular trade on Monday to $352.62 after the Model 3 comments and eased down a touch more in after hours trade, following the first-half report.

Tesla said a "severe shortfall" of new battery packs had constrained vehicle manufacturing until June, and it forecast that second-half deliveries of the Model S sedan and Model X sports utility vehicle likely would exceed those of the first half. It had forecast first-half deliveries of 47,000 to 50,000.

Most investors are focused on the outlook for the Model 3, and some analysts have been skeptical about its planned July launch after production delays and quality issues marred the launches of the Model S and Model X.
Tesla\'s shares are up more than 60 percent this year, partly on expectations of a strong launch for its Model 3, the first car the company has aimed at the mass market. Tesla has a market value of $58 billion, greater than either General Motors Co or Ford Motor Co.

In a series of posts on Twitter late on Sunday, Musk said the Model 3 had passed all regulatory requirements for production two weeks ahead of schedule.

"Production grows exponentially, so Aug should be 100 cars and Sept above 1,500," Musk said. "Looks like we can reach 20,000 Model 3 cars per month in Dec."

That is in line with targets Tesla previously set, of more than 5,000 Model 3s per week by the end of this year and 10,000 vehicles per week "at some point in 2018".
Musk said he expected SN1 - the first car off the assembly line for sale - to be completed on Friday.

Tesla has taken deposits on more than 300,000 Model 3s, starting at $35,000 a vehicle. Its popularity stands out as major U.S. automakers face a downturn. GM and Ford both reported lower sales for June on Monday.

The Model 3 marks a turning point for Tesla as it transitions from a niche luxury car manufacturer to a mass producer. The 500,000 vehicles the company plans to make next year is nearly six times its 2016 production.

Reuters reported in February that Tesla shut down production at its California assembly plant for a week to prepare for production of the Model 3 sedan, in order to meet its target of starting production in July.

(Reporting by Subrat Patnaik in Bengaluru and Peter Henderson in San Fransisco; Editing by Amrutha Gayathri and Bill Rigby)',
                'top' => 1,
                'active' => 1,
                'created_at'=> $date,
                'updated_at'=> $date,
            ],
            [
                'title' => "VW to start importing cars to Iran in August with partner Mammut Khodro",
                'percentage' => null,
                'description' => 'Volkswagen (VOWG_p.DE) will start importing cars to Iran next month, returning to the resurgent Middle Eastern market after 17 years in a move that may help the German group trim reliance on volatile overseas markets such as China and Brazil.

Volkswagen (VW) has signed an agreement with Iran\'s Mammut Khodro to import VW brand models Tiguan and Passat via eight dealerships, focusing on the greater Tehran area, VW said on Tuesday.

(Reporting by Andreas Cremer)',
                'top' => 0,
                'active' => 1,
                'created_at'=> $date,
                'updated_at'=> $date,
            ],
            [
                'title' => "Lunar robots put to the test on Sicily's Mount Etna",
                'percentage' => null,
                'description' => 'A robot wheels across a rocky, windswept landscape that looks like the surface of some distant planet from a science fiction film. But it is not in outer space, it\'s on the slopes of Europe\'s most active volcano.

Mount Etna, in Sicily, is a test bed for the approximately three-foot high, four-wheeled machine ahead of a future mission to the moon. It is being conducted by the German Aerospace Centre, the agency which runs Germany\'s space program.

The program has enlisted experts from Germany, Britain, the United States and Italy to research ROBEX (Robotic Exploration of Extreme Environments) with the aim of improving robotic equipment that will be used in space.

"This is aimed at simulating a future, hypothetical landing mission on the moon or Mars and they use a lot of robots which are there to transport and install different instruments", said Boris Behncke, a volcanologist from the National Vulcanology Institute in Catania, near Mount Etna.

Scientists also hope to use the robots to explore the depths of Mount Etna and relay back useful technical data on seismic movement. The techniques learned on Etna would then be deployed in lunar missions or in the exploration of Mars.

An initial robotic testing phase has nearly been completed on the Piano del Lago area of the volcano, a desolate stretch of terrain buffeted by strong winds.

Next, a network of equipment including rover robots and drones will be mounted to monitor seismic activity that closely simulates that which would be used on the moon.

(Reporting by Eleanor Biles Writing by Mark Hanrahan in London Editing by Jeremy Gaunt)',
                'top' => 0,
                'active' => 1,
                'created_at'=> $date,
                'updated_at'=> $date,
            ],
            [
                'title' => "Saudi Arabian Airlines expects U.S. laptop ban to be lifted by July 19: SPA",
                'percentage' => null,
                'description' => 'Saudi Arabian Airlines (Saudia) expects the in-cabin ban on laptops and other large electronics on direct flights to the United States to be lifted by July 19, state news agency SPA reported on Tuesday.

The airline is working with the country\'s civil aviation authority, GACA, to implement new security measures for U.S.-bound flights announced by the U.S. Department of Homeland Security last week, according to the report.

Saudia flies to the United States from airports in Jeddah and Riyadh.

Dubai-based Emirates, the Middle East\'s largest airline, said on Tuesday it was working to implement measures to lift the ban.

On Sunday, the United States lifted a ban on laptops in cabins on flights from Abu Dhabi to the United States, saying Etihad Airways had put in place required tighter security measures.

Turkish Airlines said on Monday it expected the ban to be lifted on flights from Turkey on July 5.

In March, the United States banned laptops in cabins on flights to the United States originating at 10 airports in eight countries -- Egypt, Morocco, Jordan, the United Arab Emirates, Saudi Arabia, Kuwait, Qatar and Turkey -- to address fears that bombs could be concealed in electronic devices taken on board.

(Reporting by Aziz El Yaakoubi; writing by Alexander Cornwell; editing by Jason Neely)',
                'top' => 0,
                'active' => 1,
                'created_at'=> $date,
                'updated_at'=> $date,
            ],
            [
                'title' => "North Korea says first intercontinental ballistic missile test successful",
                'percentage' => null,
                'description' => 'North Korea said on Tuesday it successfully test-launched an intercontinental ballistic missile (ICBM) for the first time, which flew a trajectory that experts said could allow a weapon to hit the U.S. state of Alaska.

The launch came days before leaders from the Group of 20 nations were due to discuss steps to rein in North Korea\'s weapons program, which it has pursued in defiance of U.N. Security Council sanctions.

The launch, which North Korea\'s state media said was ordered and supervised by leader Kim Jong Un, sent the rocket 933 km (580 miles) reaching an altitude of 2,802 km over a flight time of 39 minutes.

North Korea has said it wants to develop a missile mounted with a nuclear warhead capable of striking the U.S. mainland.

To do that it would need an ICBM with a range of 8,000 km (4,800 miles) or more, a warhead small enough to be mounted on it and technology to ensure its stable re-entry into the atmosphere.

Some analysts said the flight details on Tuesday suggested the new missile had a range of more than 8,000 km, underscoring major advances in its program. Other analysts said they believed its range was not so far.

Officials from South Korea, Japan and the United States said the missile landed in the sea in Japan\'s Exclusive Economic Zone after being launched on a high trajectory from near an airfield northwest of the North\'s capital, Pyongyang.

"The test launch was conducted at the sharpest angle possible and did not have any negative effect on neighboring countries," North Korea\'s state media said in a statement.

The North said its missiles were now capable of striking anywhere in the world.

"It appears the test was successful. If launched on a standard angle, the missile could have a range of more than 8,000 km," said Kim Dong-yub, a military expert at Kyungnam University\'s Institute of Far Eastern Studies in Seoul.

"But we have to see more details of the new missile to determine if North Korea has acquired ICBM technology."

South Korean President Moon Jae-in, who convened a national security council meeting, said earlier the missile was believed to be an intermediate-range type, but the military was looking into the possibility it was an ICBM.

\'HEAVY MOVE\'

U.S. President Donald Trump wrote on Twitter: "North Korea has just launched another missile. Does this guy have anything better to do with his life?" in an apparent reference to North Korean leader Kim Jong Un.',
                'top' => 1,
                'active' => 1,
                'created_at'=> $date,
                'updated_at'=> $date,
            ],
        ]);
        $insertNewCategory[] = [
            'new_id' => 1,
            'category_id' => 12 // US
        ];
        $insertNewCategory[] = [
            'new_id' => 1,
            'category_id' => 20 //Technology
        ];
        $insertNewCategory[] = [
            'new_id' => 1,
            'category_id' => 61 //Tech
        ];
        $insertNewCategory[] = [
            'new_id' => 1,
            'category_id' => 122 //Stock price up
        ];


        //2

        $insertNewCategory[] = [
            'new_id' => 2,
            'category_id' => 17 // Europe
        ];
        $insertNewCategory[] = [
            'new_id' => 2,
            'category_id' => 21 // Oil and gas
        ];
        $insertNewCategory[] = [
            'new_id' => 2,
            'category_id' => 68 // Natural gas
        ];
        $insertNewCategory[] = [
            'new_id' => 2,
            'category_id' => 67 // Oil
        ];
        $insertNewCategory[] = [
            'new_id' => 2,
            'category_id' => 95 // Dividents
        ];
        $insertNewCategory[] = [
            'new_id' => 2,
            'category_id' => 19 // Financials
        ];
        //3
        $insertNewCategory[] = [
            'new_id' => 3,
            'category_id' => 95 // Dividents
        ];
        $insertNewCategory[] = [
            'new_id' => 3,
            'category_id' => 17 // Europe
        ];
        //4
        $insertNewCategory[] = [
            'new_id' => 4,
            'category_id' => 12 // US
        ];
        $insertNewCategory[] = [
            'new_id' => 4,
            'category_id' => 20 //Technology
        ];
        $insertNewCategory[] = [
            'new_id' => 4,
            'category_id' => 61 //Tech
        ];
        $insertNewCategory[] = [
            'new_id' => 4,
            'category_id' => 122 //Stock price up
        ];

        $insertNewCategory[] = [
            'new_id' => 5,
            'category_id' => 8 // Event news
        ];
        $insertNewCategory[] = [
            'new_id' => 5,
            'category_id' => 92 //NEw product
        ];

        //6
        $insertNewCategory[] = [
            'new_id' => 6,
            'category_id' => 67 //Oil
        ];

        $insertNewCategory[] = [
            'new_id' => 6,
            'category_id' => 68
        ];
        //8

        $insertNewCategory[] = [
            'new_id' => 8,
            'category_id' => 12 // US
        ];
        $insertNewCategory[] = [
            'new_id' => 8,
            'category_id' => 20 //Technology
        ];
        $insertNewCategory[] = [
            'new_id' => 8,
            'category_id' => 61 //Tech
        ];
        $insertNewCategory[] = [
            'new_id' => 8,
            'category_id' => 122 //Stock price up
        ];
        //9

        $insertNewCategory[] = [
            'new_id' => 9,
            'category_id' => 12 // US
        ];
        $insertNewCategory[] = [
            'new_id' => 9,
            'category_id' => 20 //Technology
        ];
        $insertNewCategory[] = [
            'new_id' => 9,
            'category_id' => 61 //Tech
        ];
        $insertNewCategory[] = [
            'new_id' => 9,
            'category_id' => 122 //Stock price up
        ];

        //10

        $insertNewCategory[] = [
            'new_id' => 10,
            'category_id' => 69
        ];
        $insertNewCategory[] = [
            'new_id' => 10,
            'category_id' => 28
        ];
        $insertNewCategory[] = [
            'new_id' => 10,
            'category_id' => 107
        ];
        //11
        $insertNewCategory[] = [
            'new_id' => 11,
            'category_id' => 20
        ];
        $insertNewCategory[] = [
            'new_id' => 11,
            'category_id' => 28
        ];
        $insertNewCategory[] = [
            'new_id' => 11,
            'category_id' => 29
        ];
        $insertNewCategory[] = [
            'new_id' => 11,
            'category_id' => 92
        ];
        $insertNewCategory[] = [
            'new_id' => 11,
            'category_id' => 12
        ];
        //12
        $insertNewCategory[] = [
            'new_id' => 12,
            'category_id' => 20
        ];
        $insertNewCategory[] = [
            'new_id' => 12,
            'category_id' => 28
        ];
        $insertNewCategory[] = [
            'new_id' => 12,
            'category_id' => 29
        ];
        $insertNewCategory[] = [
        'new_id' => 12,
        'category_id' => 92
        ];
        $insertNewCategory[] = [
            'new_id' => 12,
            'category_id' => 17
        ];
        $insertNewCategory[] = [
            'new_id' => 12,
            'category_id' => 18
        ];
        //13
        $insertNewCategory[] = [
            'new_id' => 13,
            'category_id' => 20
        ];
        $insertNewCategory[] = [
            'new_id' => 13,
            'category_id' => 92
        ];
        $insertNewCategory[] = [
            'new_id' => 13,
            'category_id' => 17
        ];

        //14
        $insertNewCategory[] = [
            'new_id' => 14,
            'category_id' => 29
        ];
        $insertNewCategory[] = [
            'new_id' => 14,
            'category_id' => 18
        ];
        $insertNewCategory[] = [
            'new_id' => 14,
            'category_id' => 12
        ];
        //15

        $insertNewCategory[] = [
            'new_id' => 15,
            'category_id' => 14
        ];
        $insertNewCategory[] = [
            'new_id' => 15,
            'category_id' => 20
        ];
        $insertNewCategory[] = [
            'new_id' => 15,
            'category_id' => 61
        ];
        $insertNewCategory[] = [
            'new_id' => 15,
            'category_id' => 71
        ];
        \DB::table('new_category')->insert($insertNewCategory);

    }
}
