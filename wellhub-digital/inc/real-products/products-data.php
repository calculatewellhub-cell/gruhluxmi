<?php
/**
 * Real product content for the CalculateWellHub Women's Health & Pregnancy
 * catalog, sourced from the business's own PDF planners/workbooks. Used by
 * inc/real-products/import.php. Kept as a data file so content can be
 * reviewed/edited without touching the import logic.
 *
 * Every field here is grounded in the actual PDF content (page counts,
 * section names, tone) rather than invented copy. No medical claims are
 * made anywhere in this file, matching the disclaimers already printed
 * inside each PDF.
 *
 * @package WellHub_Digital
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function wellhub_real_products_data() {
	return array(

		'hospital-bag-complete-planner' => array(
			'title'            => 'Hospital Bag Complete Planner — Printable Packing Checklist & Prep Guide (PDF)',
			'meta_title'       => 'Hospital Bag Complete Planner (PDF) | CalculateWellHub',
			'meta_description' => "30+ page printable hospital bag checklist for mom, baby & partner, plus a birth-day prep guide and contacts tracker. Instant PDF download.",
			'focus_keyword'    => 'hospital bag checklist',
			'category'         => 'Pregnancy',
			'price'            => '9.00',
			'sale_price'       => '',
			'format'           => 'PDF',
			'pages'            => '30',
			'file'             => 'hospital-bag-complete-planner.pdf',
			'badges'           => array(),
			'short_description' => "A 30+ page printable hospital bag planner covering the pack list for you, your baby and your partner, along with a birth-day checklist and important-contacts tracker so nothing gets forgotten.",
			'description'      => "<h3>Pack for the hospital without the last-minute scramble</h3>
<p>The Hospital Bag Complete Planner turns \"I should probably start packing\" into a clear, room-by-room system. Instead of one long list, you get separate checklists for your bag, baby's bag and your partner's bag — each with a \"packed\" and \"where it's stored\" column so you always know what's ready and where to find it.</p>
<h3>What it helps you do</h3>
<ul>
<li>Record your hospital or birth center details, provider and important contacts in one place</li>
<li>Work through packing checklists by category instead of trying to remember everything at once</li>
<li>Track documents, electronics and comfort items separately so nothing gets left behind</li>
<li>Do a final birth-day preparation check before you leave home</li>
</ul>
<h3>Who it's for</h3>
<p>Expecting parents in their second or third trimester who want a calm, practical way to get hospital-ready — whether this is a first baby or not.</p>",
			'whats_included'   => array(
				"Hospital & birth information page (facility, provider, due date)",
				"Important contacts tracker",
				"Item-by-item packing checklist with \"packed\" and \"where it's stored\" columns",
				"Documents checklist (ID, insurance, hospital forms)",
				"Electronics & chargers checklist",
				"Comfort items checklist",
				"Birth-day preparation checklist",
				"Before-leaving-home final check",
			),
			'faq'              => array(
				array( "What's the difference between this and the Pregnancy Birth Prep & Hospital-Ready Planner?", "This planner focuses specifically on packing — what to bring and tracking what's packed and where. The Birth Prep & Hospital-Ready Planner is a broader final-weeks organizer covering key dates, home readiness and your communication plan." ),
				array( "Is this a fillable PDF or a printable one?", "It's designed to be printed and filled in by hand, so you can pin pages up or keep them in a binder as you pack." ),
				array( "When should I start using it?", "Most people start in the third trimester, but you can begin whenever you'd like to feel organized." ),
				array( "Does it replace advice from my hospital or provider?", "No. It's an organizational tool only — always confirm what to bring with your hospital or birth center, since policies vary." ),
			),
		),

		'pregnancy-birth-prep-hospital-ready-planner' => array(
			'title'            => 'Pregnancy Birth Prep & Hospital-Ready Planner — Final Weeks Organizer (PDF)',
			'meta_title'       => 'Birth Prep & Hospital-Ready Planner (PDF) | CalculateWellHub',
			'meta_description' => '33-page final-weeks planner: birth prep dashboard, key contacts, home-readiness check and a backup plan — everything organized before baby arrives.',
			'focus_keyword'    => 'pregnancy birth prep planner',
			'category'         => 'Pregnancy',
			'price'            => '11.00',
			'sale_price'       => '',
			'format'           => 'PDF',
			'pages'            => '33',
			'file'             => 'pregnancy-birth-prep-hospital-ready-planner.pdf',
			'badges'           => array(),
			'short_description' => "A 33-page final-weeks planner built around a one-page birth-prep dashboard, key dates and documents, a home-readiness check, and a backup plan for if things change.",
			'description'      => "<h3>A simple system for the final weeks before baby arrives</h3>
<p>This planner turns the overwhelming end of pregnancy into a clear, manageable plan. It starts with a one-page Birth Prep Dashboard — your due date, birth facility, provider, main support person and this week's top priorities — so you always know what still needs attention at a glance.</p>
<h3>What it helps you do</h3>
<ul>
<li>Keep key dates, documents and important contacts in one place</li>
<li>Run through a home-readiness check before your due date</li>
<li>Put together a final-week backup plan in case circumstances change</li>
<li>Organize questions, priorities and communication for your birth team</li>
</ul>
<h3>Who it's for</h3>
<p>Expecting parents who want one command center for the logistics of the final weeks, rather than scattered notes across their phone.</p>",
			'whats_included'   => array(
				"Birth prep dashboard (due date, facility, provider, top priorities)",
				"Important contacts page",
				"Key dates & documents tracker",
				"Home readiness checklist",
				"Final-week backup plan",
				"Coping & communication planning pages",
				"Final-ready checklist",
			),
			'faq'              => array(
				array( "How is this different from the Hospital Bag Complete Planner?", "This planner is a broader command center for the final weeks — dates, contacts, home readiness and your backup plan. Pair it with the Hospital Bag Complete Planner if you also want a dedicated, detailed packing checklist." ),
				array( "Can I use this alongside my hospital's own paperwork?", "Yes — it's designed to organize your own notes and priorities alongside whatever forms your hospital or birth center provides." ),
				array( "Is medical advice included?", "No. It's an organizational and reflection tool; always follow guidance from your own healthcare provider." ),
			),
		),

		'birth-plan-birth-preferences-workbook' => array(
			'title'            => 'Birth Plan & Birth Preferences Workbook — Printable PDF Template',
			'meta_title'       => 'Birth Plan & Preferences Workbook (PDF) | CalculateWellHub',
			'meta_description' => 'A 24-page printable workbook to organize your labor, pain-relief, comfort and newborn preferences into a clear birth plan for your care team.',
			'focus_keyword'    => 'birth plan template',
			'category'         => 'Pregnancy',
			'price'            => '8.00',
			'sale_price'       => '',
			'format'           => 'PDF',
			'pages'            => '24',
			'file'             => 'birth-plan-birth-preferences-workbook.pdf',
			'badges'           => array(),
			'short_description' => "A 24-page workbook for organizing your labor, pain-relief, comfort and newborn-care preferences into one clear birth plan you can bring to prenatal appointments and your birth location.",
			'description'      => "<h3>Put your birth preferences into words your care team can act on</h3>
<p>A birth plan is a communication tool — this workbook helps you think through what matters most to you and summarize it clearly. Start with an at-a-glance page for your top priorities, then work through detailed sections for labor, pain relief, comfort and newborn care.</p>
<h3>What it helps you do</h3>
<ul>
<li>Summarize your top birth priorities on one easy-to-share page</li>
<li>Think through labor environment, movement, pain relief and comfort preferences</li>
<li>Record cesarean, cord & placenta, and immediate newborn preferences</li>
<li>Note your feeding preferences and finish with a complete checklist</li>
</ul>
<h3>Who it's for</h3>
<p>Expecting parents who want a structured way to prepare for conversations with their healthcare provider and birth location before labor begins.</p>",
			'whats_included'   => array(
				"Birth preferences at a glance summary page",
				"Labor & birth environment preferences",
				"Movement & position preferences",
				"Pain relief and comfort preferences",
				"Cesarean birth preferences",
				"Cord & placenta preferences",
				"Immediate newborn preferences",
				"Feeding preferences",
				"Final birth preferences checklist",
			),
			'faq'              => array(
				array( "Will my care team follow everything in my birth plan?", "Your preferences are a communication tool. Your team may need to adapt them based on how labor unfolds and your hospital's policies — that's normal and expected." ),
				array( "When should I fill this out?", "Most people complete it in the third trimester and review it with their healthcare provider before labor." ),
				array( "Is it only for hospital births?", "No — there are sections for hospital, birth center or home birth preferences." ),
			),
		),

		'ultimate-pregnancy-planner-keepsake-bundle' => array(
			'title'            => 'Ultimate Pregnancy Planner & Keepsake Bundle — 88-Page All-in-One PDF',
			'meta_title'       => 'Ultimate Pregnancy Planner & Keepsake Bundle (88pg PDF)',
			'meta_description' => 'An 88-page all-in-one pregnancy planner and keepsake journal: weekly journal pages, appointment trackers, birth & registry planning, and memory pages.',
			'focus_keyword'    => 'pregnancy planner bundle',
			'category'         => 'Pregnancy',
			'price'            => '24.00',
			'sale_price'       => '19.00',
			'format'           => 'PDF',
			'pages'            => '88',
			'file'             => 'ultimate-pregnancy-planner-keepsake-bundle.pdf',
			'badges'           => array( 'bundle', 'featured' ),
			'short_description' => "An 88-page all-in-one planner and keepsake journal combining weekly pregnancy journaling, appointment and health trackers, birth and registry planning, and memory pages to look back on for years.",
			'description'      => "<h3>One planner to organize, track and remember your pregnancy</h3>
<p>The Ultimate Pregnancy Planner & Keepsake Bundle is designed to help you organize appointments and preparations, track personal notes and routines, and preserve the moments you'll want to remember for years to come — all in one 88-page PDF.</p>
<h3>What it helps you do</h3>
<ul>
<li>Journal week by week across 40 dedicated weekly pages</li>
<li>Prepare questions and log notes for every appointment</li>
<li>Track health, nutrition, activity and rest alongside ultrasound and memory pages</li>
<li>Plan birth preferences, hospital logistics, registry, nursery and baby names</li>
<li>Organize your baby shower and postpartum preparation</li>
<li>Record your birth story and your baby's first five weeks</li>
</ul>
<h3>Who it's for</h3>
<p>Anyone who wants a single, all-in-one planner and keepsake rather than juggling several separate trackers — print only the pages you'll use more than once.</p>",
			'whats_included'   => array(
				"Pregnancy-at-a-glance dashboard",
				"40 weekly journal pages",
				"Appointment and provider-question pages",
				"Health, nutrition, activity and rest logs",
				"Ultrasound and memory pages",
				"Birth preferences and hospital planning",
				"Baby registry, nursery and name planning",
				"Baby shower planning and postpartum preparation",
				"Birth story and first five weeks of baby memories",
			),
			'faq'              => array(
				array( "Is this the same as buying the other planners separately?", "It overlaps in places but is built as one continuous journal-style keepsake rather than separate checklists. Many customers use this as their main planner and add a focused workbook — like the Birth Plan Workbook — for extra detail." ),
				array( "Do I need to print all 88 pages?", "No — print only the sections you plan to use more than once; the rest can be filled in digitally or skipped." ),
				array( "Is this a fillable PDF?", "It's formatted for printing and handwriting, so you can keep it as a physical keepsake." ),
				array( "What if I don't finish every page?", "That's completely fine — it's designed to be used flexibly, not completed in order." ),
			),
		),

		'postpartum-preparation-planner' => array(
			'title'            => 'Postpartum Preparation Planner — Printable PDF for Life After Birth',
			'meta_title'       => 'Postpartum Preparation Planner (PDF) | CalculateWellHub',
			'meta_description' => 'A 22-page printable planner to prepare your support team, home, meals and recovery plan before baby arrives — calm, practical postpartum prep.',
			'focus_keyword'    => 'postpartum planner',
			'category'         => 'Postpartum',
			'price'            => '8.00',
			'sale_price'       => '',
			'format'           => 'PDF',
			'pages'            => '22',
			'file'             => 'postpartum-preparation-planner.pdf',
			'badges'           => array(),
			'short_description' => "A 22-page workbook for organizing your support team, meals, home and recovery plan before your baby arrives, so postpartum days feel calmer and more prepared.",
			'description'      => "<h3>Prepare for life after birth, one practical page at a time</h3>
<p>Postpartum recovery and newborn care look different for every family. This calming workbook helps you organize practical details, identify support, and prepare questions for your healthcare team — before your due date, while you have time to think it through.</p>
<h3>What it helps you do</h3>
<ul>
<li>Name your postpartum priorities and the support you'd like to receive</li>
<li>Build a support-team page with names, roles and how people can help</li>
<li>Plan feeding & supplies, meals & household tasks, and home preparation</li>
<li>Prepare for healthcare follow-ups and your emotional well-being</li>
</ul>
<h3>Who it's for</h3>
<p>Expecting parents who want to walk into the postpartum period with a plan already in place, not figure it all out in the moment.</p>",
			'whats_included'   => array(
				"Postpartum priorities & at-a-glance summary",
				"Support team page",
				"Feeding & supplies plan",
				"Meals & household plan",
				"Home preparation checklist",
				"Healthcare & follow-up planner",
				"Emotional & mental well-being plan",
				"Communication & privacy plan",
				"Ready-to-go checklist",
			),
			'faq'              => array(
				array( "When should I fill this out?", "Most people complete it during the third trimester, before their due date." ),
				array( "Is this a medical recovery guide?", "No — it's an organizational tool to plan practical support and logistics. Always follow your healthcare team's guidance for recovery." ),
				array( "Can my partner or support person use it too?", "Yes, the support-team and communication pages are designed to be filled in together." ),
			),
		),

		'new-moms-first-30-days-planner' => array(
			'title'            => "New Mom's First 30 Days Planner — Daily Postpartum Planner (PDF)",
			'meta_title'       => "New Mom's First 30 Days Planner (PDF) | CalculateWellHub",
			'meta_description' => "A 53-page day-by-day planner for the first month after birth: feeding & sleep notes, support team, visitors & boundaries, gentle daily check-ins.",
			'focus_keyword'    => 'new mom planner',
			'category'         => 'Postpartum',
			'price'            => '14.00',
			'sale_price'       => '',
			'format'           => 'PDF',
			'pages'            => '53',
			'file'             => 'new-moms-first-30-days-planner.pdf',
			'badges'           => array( 'bestseller' ),
			'short_description' => "A 53-page day-by-day planner for the first month home with your baby, with space to track feeding, sleep, support and your own daily check-ins — flexible, not a rigid schedule.",
			'description'      => "<h3>Gentle structure for the first 30 days home with your baby</h3>
<p>The first month with a new baby can change from one day to the next. This planner gives you 30 days of gentle structure and practical tracking — use only the pages that help, and skip, repeat or adapt sections whenever your needs change.</p>
<h3>What it helps you do</h3>
<ul>
<li>Set a simple daily focus instead of trying to do everything</li>
<li>Track feeding, diapers and sleep alongside meals and hydration</li>
<li>Coordinate help through a support-team and help-request page</li>
<li>Plan visitors and boundaries, and check in on your own self-care</li>
<li>Review your week and reset priorities for the month ahead</li>
</ul>
<h3>Who it's for</h3>
<p>New moms (and their support people) who want a flexible daily companion for the fourth trimester — not a rigid schedule to fail at.</p>",
			'whats_included'   => array(
				"First-month priorities & intentions",
				"Support team & help-request pages",
				"Daily basics tracker (feeding, diapers, sleep)",
				"Meals & hydration tracker",
				"Self-care & personal check-in",
				"Visitors & boundaries planning page",
				"Baby & home supply check",
				"Weekly rhythm review",
				"Next-month priorities page",
			),
			'faq'              => array(
				array( "Do I need to fill in every day?", "No — the planner is built to be flexible. Skip, repeat or adapt sections as your needs change." ),
				array( "Is this only for the birthing parent?", "The support-team and visitor-boundary pages work well for partners and family to reference too." ),
				array( "Does it cover medical postpartum recovery advice?", "No — it's for planning and organization only, not medical guidance." ),
			),
		),

		'womens-wellness-planner' => array(
			'title'            => "Women's Wellness Planner — Printable Daily Habit & Self-Care Tracker (PDF)",
			'meta_title'       => "Women's Wellness Planner (PDF) | CalculateWellHub",
			'meta_description' => "A 32-page printable wellness planner for tracking sleep, hydration, movement, mood and self-care — build sustainable routines at your pace.",
			'focus_keyword'    => "women's wellness planner",
			'category'         => "Women's Wellness",
			'price'            => '10.00',
			'sale_price'       => '',
			'format'           => 'PDF',
			'pages'            => '32',
			'file'             => 'womens-wellness-planner.pdf',
			'badges'           => array(),
			'short_description' => "A 32-page printable planner for building simple, sustainable wellness routines — daily check-ins for sleep, hydration, movement, mood and self-care, plus a monthly review.",
			'description'      => "<h3>Wellness that doesn't have to be perfect to be meaningful</h3>
<p>This planner is a simple guide for building healthy, sustainable routines. Use it to organize daily habits, reflect on how you're feeling, and create routines that actually fit your life — choose the pages that are useful to you and use them daily, weekly, or whenever you want to reset.</p>
<h3>What it helps you do</h3>
<ul>
<li>Choose one or two realistic wellness priorities instead of everything at once</li>
<li>Check in daily on your energy, mood and habits</li>
<li>Track sleep, hydration, movement and nutrition without judgment</li>
<li>Review your progress each week and each month</li>
</ul>
<h3>Who it's for</h3>
<p>Anyone who wants a flexible, non-restrictive way to notice patterns in their energy, mood, rest and routines — for wellness planning and organization only.</p>",
			'whats_included'   => array(
				"Wellness priorities & 30-day intention pages",
				"Daily wellness check-in (energy, mood, habits)",
				"Sleep & rest tracker",
				"Hydration tracker",
				"Movement & activity planner",
				"Meal planning & nutrition notes",
				"Stress & emotional well-being check-in",
				"Self-care planner",
				"Monthly wellness review",
				"Health appointments & questions page",
			),
			'faq'              => array(
				array( "Do I need to use every page every day?", "No — choose the pages that are useful to you and use them daily, weekly, or whenever you want to reset." ),
				array( "Is this a medical or nutrition program?", "No — it's a planning and organization tool only, not medical or nutritional advice." ),
				array( "Can I reuse it month to month?", "Yes — the monthly review and daily check-in pages are designed to be printed again for each new month." ),
			),
		),

		'period-tracker-journal-annual' => array(
			'title'            => 'Period Tracker Journal — Annual Cycle & Wellness Journal (PDF)',
			'meta_title'       => 'Annual Period Tracker Journal (PDF) | CalculateWellHub',
			'meta_description' => 'A 20-page annual period tracker journal covering cycle, symptoms, mood, sleep and self-care — plus a year-end review of your patterns.',
			'focus_keyword'    => 'period tracker journal',
			'category'         => "Women's Wellness",
			'price'            => '6.00',
			'sale_price'       => '',
			'format'           => 'PDF',
			'pages'            => '20',
			'file'             => 'period-tracker-journal-annual.pdf',
			'badges'           => array( 'new' ),
			'short_description' => "A 20-page annual period tracker journal for logging your cycle, symptoms, mood and sleep month by month, with a year-end review to spot patterns over time.",
			'description'      => "<h3>Get to know your cycle, one month at a time</h3>
<p>This journal is designed to help you track your menstrual cycle, symptoms, and overall wellness — giving you a comprehensive overview of your health journey while encouraging self-awareness. By consistently filling in your entries, you'll start to notice patterns that can inform your self-care choices.</p>
<h3>What it helps you do</h3>
<ul>
<li>Log flow, symptoms and cramps for each cycle</li>
<li>Track mood, energy, sleep and lifestyle habits alongside your cycle</li>
<li>Check in on self-care throughout the month</li>
<li>Prepare questions for your healthcare provider</li>
<li>Review the whole year at once with a year-end insights page</li>
</ul>
<h3>Who it's for</h3>
<p>Anyone who wants to track a full year of cycles in one place and reflect on longer-term patterns, not just a single month.</p>",
			'whats_included'   => array(
				"Cycle profile overview",
				"Annual cycle milestones map",
				"Monthly cycle & flow tracker",
				"Symptoms & cramps log",
				"Mood & energy tracker",
				"Sleep & lifestyle notes",
				"Self-care check-in",
				"Monthly pattern review",
				"Questions-for-provider page",
				"Year-end insights & reflection",
			),
			'faq'              => array(
				array( "Is this journal dated or undated?", "It's built around a full year of tracking with a year-end review — great if you want to look back on longer-term patterns." ),
				array( "Can I use it to diagnose a cycle issue?", "No — it's for personal tracking and self-awareness only. Bring your notes to a healthcare provider for any medical concerns." ),
				array( "Is it different from the Undated Period Tracker & Journal?", "Yes — this edition is built around an annual overview and year-end reflection, while the Undated edition is a simpler, month-by-month printable tracker you can start any time." ),
			),
		),

		'period-tracker-journal-undated' => array(
			'title'            => 'Period Tracker & Journal — Undated Printable Cycle Tracker (PDF)',
			'meta_title'       => 'Undated Period Tracker & Journal (PDF) | CalculateWellHub',
			'meta_description' => 'A 23-page undated, printable period tracker for logging flow, symptoms, mood and energy month by month — start any time, no dates wasted.',
			'focus_keyword'    => 'printable period tracker',
			'category'         => "Women's Wellness",
			'price'            => '7.00',
			'sale_price'       => '',
			'format'           => 'PDF',
			'pages'            => '23',
			'file'             => 'period-tracker-journal-undated.pdf',
			'badges'           => array(),
			'short_description' => "A 23-page undated, printable period and cycle journal — start tracking any month, log flow, symptoms, mood and energy, and prepare notes for your next healthcare appointment.",
			'description'      => "<h3>A simple, thoughtful way to notice patterns in your cycle</h3>
<p>Your cycle can vary from month to month. This undated journal is designed to help you record what you notice — flow, symptoms, mood, energy and everyday wellness — rather than to diagnose a condition. Start any month you like; there are no wasted dated pages.</p>
<h3>What it helps you do</h3>
<ul>
<li>Get a quick cycle-at-a-glance overview</li>
<li>Fill in undated monthly tracker grids for flow and mood</li>
<li>Log symptom details and overall well-being</li>
<li>Compare observations across months with a monthly cycle review</li>
<li>Prepare notes and questions for your healthcare provider</li>
</ul>
<h3>Who it's for</h3>
<p>Anyone who wants a simple, no-pressure printable tracker they can start using immediately, without waiting for a specific month or date.</p>",
			'whats_included'   => array(
				"Cycle-at-a-glance overview",
				"Undated monthly tracker grids",
				"Symptom details log",
				"Symptoms & well-being tracker",
				"Mood, energy & lifestyle notes",
				"Monthly cycle review",
				"Questions for your healthcare provider",
				"Tracking wrap-up & pattern notes",
			),
			'faq'              => array(
				array( "Why is it undated?", "So you can start tracking in any month without wasting pages — just fill in the month and year yourself." ),
				array( "Will this tell me if something is wrong with my cycle?", "No — it's designed to help you notice and record patterns, not to diagnose. Share your notes with a healthcare professional if something concerns you." ),
				array( "Can I print it more than once?", "Yes — it's designed to be reprinted each month or year as needed." ),
			),
		),

	);
}
