<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Services
    |--------------------------------------------------------------------------
    */

    'services' => [

        'web' => [
            'title' => 'Company website',
            'summary' => 'A modern, fast and SEO-friendly website that presents your organization, brand and products professionally.',
            'features' => ['Responsive design', 'Content management', 'SEO setup'],
            'tagline' => 'Your business’s digital face, open 24/7',
            'intro' => 'Customers look you up online first. We design and build a website that matches your brand, works flawlessly on every device and is easy to find on Google — from the first sketch to launch.',
            'includes' => [
                ['icon' => 'icon-[tabler--palette]', 'title' => 'Unique design', 'text' => 'UI/UX designed for your brand, not a ready-made template.'],
                ['icon' => 'icon-[tabler--device-mobile]', 'title' => 'Every device', 'text' => 'Looks great on phones, tablets and computers.'],
                ['icon' => 'icon-[tabler--layout-dashboard]', 'title' => 'Admin panel', 'text' => 'Update news, images and content yourself.'],
                ['icon' => 'icon-[tabler--search]', 'title' => 'SEO setup', 'text' => 'All the technical setup needed to be found on Google.'],
                ['icon' => 'icon-[tabler--language]', 'title' => 'Multiple languages', 'text' => 'Mongolian, English and other language versions.'],
                ['icon' => 'icon-[tabler--shield-lock]', 'title' => 'SSL & security', 'text' => 'HTTPS encryption, form protection and backups.'],
            ],
            'ideal_for' => ['Company and organization profiles', 'Service businesses (clinics, salons, training)', 'Landing pages for new products or brands', 'Personal portfolios'],
            'faqs' => [
                ['question' => 'How long does it take to build a website?', 'answer' => 'A company website is usually ready in 2–4 weeks, depending on the number of pages and how ready the content is.'],
                ['question' => 'Do you handle the domain and hosting?', 'answer' => 'Yes. We take care of domain registration, the server and SSL, and hand over a fully working site.'],
                ['question' => 'Can I edit the content myself later?', 'answer' => 'Yes. You can update news, images and text through the admin panel without any coding.'],
            ],
            'seo_title' => 'Website development — company websites',
            'seo_description' => 'Website development: unique design, works on every device, admin panel, SEO setup and SSL. Get a quote for your company website.',
        ],

        'payments' => [
            'title' => 'Online payments',
            'summary' => 'We securely and reliably connect bank, QR and card payment solutions to your system.',
            'features' => ['QR payments', 'Card payments', 'Automatic confirmation'],
            'tagline' => 'Collect payments automatically and stop checking them by hand',
            'intro' => 'When customers scan a QR code or pay by card on your site, the payment is confirmed automatically and the order is marked as paid instantly. We connect QPay and other payment providers to your website or system.',
            'includes' => [
                ['icon' => 'icon-[tabler--qrcode]', 'title' => 'QR payments', 'text' => 'QR invoices that any banking app can scan.'],
                ['icon' => 'icon-[tabler--credit-card]', 'title' => 'Card payments', 'text' => 'Accept domestic and international cards.'],
                ['icon' => 'icon-[tabler--bolt]', 'title' => 'Instant confirmation', 'text' => 'Orders update the moment the payment arrives.'],
                ['icon' => 'icon-[tabler--receipt]', 'title' => 'Transaction history', 'text' => 'Track every payment from the admin panel.'],
                ['icon' => 'icon-[tabler--refresh]', 'title' => 'Refunds & duplicates', 'text' => 'Correct handling of double payments and cancellations.'],
                ['icon' => 'icon-[tabler--lock]', 'title' => 'Secure connection', 'text' => 'API keys protected on the server, connected over HTTPS.'],
            ],
            'ideal_for' => ['Online stores', 'Course and booking systems', 'Tickets and service prepayments', 'Memberships and monthly fees'],
            'faqs' => [
                ['question' => 'Who signs the contract with the payment provider?', 'answer' => 'Your organization signs directly with the payment provider. We guide you through registration and handle the entire technical integration.'],
                ['question' => 'Can you add payments to my existing site?', 'answer' => 'In most cases, yes. We review your site’s technology and confirm what is possible.'],
                ['question' => 'How long does the integration take?', 'answer' => 'Once the contract and API keys are ready, testing and launch usually take 1–2 weeks.'],
            ],
            'seo_title' => 'Online payment integration — QPay, QR and cards',
            'seo_description' => 'Connect QPay, QR and card payments to your website or system: automatic confirmation, transaction history and a secure connection.',
        ],

        'ecommerce' => [
            'title' => 'E-commerce',
            'summary' => 'A full-featured online store to manage products, orders, delivery and inventory in one place.',
            'features' => ['Order management', 'Inventory tracking', 'Reports & analytics'],
            'tagline' => 'Keep your store open 24 hours a day',
            'intro' => 'Sell your products online and manage orders, payments, delivery and stock from a single system, built around how your business works.',
            'includes' => [
                ['icon' => 'icon-[tabler--package]', 'title' => 'Products', 'text' => 'Categories, variants (colour, size), images and prices.'],
                ['icon' => 'icon-[tabler--shopping-cart]', 'title' => 'Cart & orders', 'text' => 'A simple checkout and clear order statuses.'],
                ['icon' => 'icon-[tabler--qrcode]', 'title' => 'Online payments', 'text' => 'QR and card payments confirmed automatically.'],
                ['icon' => 'icon-[tabler--truck-delivery]', 'title' => 'Delivery', 'text' => 'Delivery zones, fees and status notifications.'],
                ['icon' => 'icon-[tabler--building-warehouse]', 'title' => 'Inventory', 'text' => 'Stock updates automatically and warns when it runs low.'],
                ['icon' => 'icon-[tabler--chart-bar]', 'title' => 'Reports', 'text' => 'Sales, best sellers and revenue statistics.'],
            ],
            'ideal_for' => ['Fashion and beauty stores', 'Electronics and equipment', 'Food and grocery delivery', 'Businesses selling on Facebook'],
            'faqs' => [
                ['question' => 'How many products can I add?', 'answer' => 'Unlimited. The system is built to stay fast even with thousands of products.'],
                ['question' => 'Can it connect to my Facebook page?', 'answer' => 'Yes. You can link Facebook and Messenger to the store and connect a product catalogue.'],
                ['question' => 'How long does an online store take?', 'answer' => 'Usually 4–8 weeks, depending on your requirements.'],
            ],
            'seo_title' => 'Online store development — e-commerce websites',
            'seo_description' => 'E-commerce development: products, cart, QR payments, delivery, inventory and sales reports. Get a quote for your online store.',
        ],

        'server-setup' => [
            'title' => 'Server setup',
            'summary' => 'Professional server installation, security, domain, SSL, backup and monitoring configuration.',
            'features' => ['SSL & security', 'Automatic backups', 'Monitoring'],
            'tagline' => 'Your system runs fast, reliably and securely',
            'intro' => 'A badly configured server is slow and vulnerable. We set up your server professionally — from installation to security, backups and monitoring — so it keeps running without interruption.',
            'includes' => [
                ['icon' => 'icon-[tabler--server-cog]', 'title' => 'Server installation', 'text' => 'Linux, web server and database configuration.'],
                ['icon' => 'icon-[tabler--world]', 'title' => 'Domain & DNS', 'text' => 'Domain connection and email DNS records.'],
                ['icon' => 'icon-[tabler--certificate]', 'title' => 'SSL certificate', 'text' => 'HTTPS with automatically renewing certificates.'],
                ['icon' => 'icon-[tabler--shield-check]', 'title' => 'Security', 'text' => 'Firewall, SSH hardening and updates.'],
                ['icon' => 'icon-[tabler--database-export]', 'title' => 'Automatic backups', 'text' => 'Regular backups that can be restored.'],
                ['icon' => 'icon-[tabler--activity-heartbeat]', 'title' => 'Monitoring', 'text' => 'Instant alerts when the server goes down or gets overloaded.'],
            ],
            'ideal_for' => ['Businesses with a new server', 'Slow websites', 'Hosting your own system or ERP', 'Improving security'],
            'faqs' => [
                ['question' => 'Which hosting providers do you work with?', 'answer' => 'Most local and international VPS and cloud providers. If you do not have a server, you can rent one from us.'],
                ['question' => 'Can you migrate a live site without downtime?', 'answer' => 'Yes. We test the migration in advance and plan it to keep downtime to a minimum.'],
                ['question' => 'Do you provide support afterwards?', 'answer' => 'Yes. We offer a monthly maintenance plan covering monitoring, updates and backups.'],
            ],
            'seo_title' => 'Server setup — SSL, backups and security',
            'seo_description' => 'Server setup service: Linux, web server, domain DNS, SSL certificates, firewall, automatic backups and monitoring for a fast, reliable server.',
        ],

        'server-rental' => [
            'title' => 'Server rental',
            'summary' => 'Rent servers sized to your business needs on flexible terms at an affordable price.',
            'features' => ['Flexible plans', 'Scalable', 'Technical support'],
            'tagline' => 'Rent only what you need instead of buying expensive servers',
            'intro' => 'Buying, hosting and maintaining your own server is expensive. We rent out ready-configured VPS servers monthly or yearly and can increase their capacity in minutes as your needs grow.',
            'includes' => [
                ['icon' => 'icon-[tabler--cpu]', 'title' => 'Guaranteed resources', 'text' => 'CPU, RAM and disk reserved just for you.'],
                ['icon' => 'icon-[tabler--arrows-maximize]', 'title' => 'Scalable', 'text' => 'Upgrade your plan in minutes when traffic grows.'],
                ['icon' => 'icon-[tabler--terminal-2]', 'title' => 'Full access', 'text' => 'Root access to install any software.'],
                ['icon' => 'icon-[tabler--database-export]', 'title' => 'Backups', 'text' => 'Regular server snapshots.'],
                ['icon' => 'icon-[tabler--certificate]', 'title' => 'SSL & domain', 'text' => 'HTTPS and domain connection ready to go.'],
                ['icon' => 'icon-[tabler--headset]', 'title' => 'Technical support', 'text' => 'Our engineers fix issues when they arise.'],
            ],
            'ideal_for' => ['Websites and online stores', 'Internal company systems', 'Databases and APIs', 'Test environments'],
            'faqs' => [
                ['question' => 'What is the minimum rental period?', 'answer' => 'Plans start monthly. Paying yearly saves more.'],
                ['question' => 'Where are the servers located?', 'answer' => 'Depending on your needs you can choose local or international data centres.'],
                ['question' => 'Can I add capacity later?', 'answer' => 'Yes. CPU, RAM and disk can be increased without losing data.'],
            ],
            'seo_title' => 'Server rental — VPS hosting',
            'seo_description' => 'VPS server rental: guaranteed CPU and RAM, root access, backups, SSL and technical support. Flexible monthly and yearly plans at an affordable price.',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Frequently Asked Questions
    |--------------------------------------------------------------------------
    */

    'faq' => [
        ['question' => 'How long does it take to build a website?', 'answer' => 'A company website usually takes 2–4 weeks, while e-commerce and payment-enabled systems take 4–8 weeks depending on requirements.'],
        ['question' => 'How do I get a quote?', 'answer' => 'Send a request using the contact form. Our team will contact you, clarify your needs and then send a quote.'],
        ['question' => 'What are the terms for server rental?', 'answer' => 'We offer flexible monthly and yearly plans, and capacity can easily be increased as your needs grow.'],
        ['question' => 'Do you provide support after launch?', 'answer' => 'Yes. We continue to provide maintenance, updates and technical advice.'],
        ['question' => 'Can you redesign my existing website?', 'answer' => 'Yes. We review your current system and propose ways to improve its design and performance.'],
        ['question' => 'Do you handle domains and hosting?', 'answer' => 'Yes. We take care of domain registration, the server, SSL and email setup.'],
        ['question' => 'Can you connect QPay and card payments?', 'answer' => 'Yes. We advise you on the contract with the payment provider and handle the full technical integration.'],
        ['question' => 'How is payment arranged?', 'answer' => 'Work is delivered in stages and can be paid in instalments according to the schedule in the contract.'],
    ],

    /*
    |--------------------------------------------------------------------------
    | Knowledge Articles
    |--------------------------------------------------------------------------
    */

    'articles' => [

        'what-is-a-website' => [
            'title' => 'What is a website?',
            'lead' => 'Your business’s digital face on the internet — open to anyone, anywhere, at any time.',
            'reading_time' => '3 minutes',
            'seo_description' => 'What a website is, how it works, the main types and how one is built — explained simply.',
            'blocks' => [
                [
                    'type' => 'tree',
                    'title' => 'How does a website work?',
                    'nodes' => [
                        ['label' => 'Domain', 'text' => 'The site’s address, e.g. shijimglobal.com'],
                        ['label' => 'Server', 'text' => 'Stores and delivers the site’s files and data 24/7'],
                        ['label' => 'Code & design', 'text' => 'Defines how the site looks and works'],
                        ['label' => 'SSL', 'text' => 'Encrypts the connection between visitor and site'],
                    ],
                    'result' => ['label' => 'Result', 'text' => 'Type the address and your site opens in a second'],
                ],
                [
                    'type' => 'callout',
                    'kicker' => 'Your business is',
                    'headline' => 'OPEN 24/7',
                    'text' => 'A website presents your business, collects enquiries and sells even at night and on weekends.',
                    'icon' => 'icon-[tabler--clock-24]',
                ],
                [
                    'type' => 'cards',
                    'title' => 'What types are there?',
                    'items' => [
                        ['icon' => 'icon-[tabler--building]', 'title' => 'Company site', 'text' => 'Introduce your organization and services.'],
                        ['icon' => 'icon-[tabler--shopping-bag]', 'title' => 'Online store', 'text' => 'Sell products online and take payments.'],
                        ['icon' => 'icon-[tabler--apps]', 'title' => 'Web system', 'text' => 'Automate bookings, records and internal work.'],
                        ['icon' => 'icon-[tabler--rocket]', 'title' => 'Landing page', 'text' => 'Promote a single product or campaign.'],
                    ],
                ],
                [
                    'type' => 'flow',
                    'title' => 'How is a website built?',
                    'steps' => [
                        ['title' => 'Consultation', 'text' => 'Define goals and needs'],
                        ['title' => 'Design', 'text' => 'Approve the look together'],
                        ['title' => 'Development', 'text' => 'Write the code and test it'],
                        ['title' => 'Launch', 'text' => 'Deploy to the server and go live'],
                    ],
                ],
            ],
        ],

        'server-and-vps' => [
            'title' => 'What are servers and VPS?',
            'lead' => 'A server is a powerful computer that keeps your website or system running 24/7. A VPS splits one virtually and gives you a dedicated environment of your own.',
            'reading_time' => '4 minutes',
            'seo_description' => 'What servers and VPS are, how they work, the difference between shared hosting, VPS and dedicated servers, and when to choose a VPS.',
            'blocks' => [
                [
                    'type' => 'tree',
                    'title' => 'How does a VPS work?',
                    'nodes' => [
                        ['label' => 'Virtualization', 'text' => 'One powerful physical server is split into independent parts'],
                        ['label' => 'Guaranteed resources', 'text' => 'CPU, RAM and disk are reserved for you alone'],
                        ['label' => 'Root access', 'text' => 'Install any software and settings you need'],
                        ['label' => 'Isolation', 'text' => 'Other users’ load and errors never affect your server'],
                    ],
                    'result' => ['label' => 'Business value', 'text' => 'The benefits of a dedicated server at a lower price'],
                ],
                [
                    'type' => 'compare',
                    'title' => 'Which one fits you?',
                    'highlight' => 1,
                    'columns' => ['Shared hosting', 'VPS', 'Dedicated server'],
                    'rows' => [
                        ['label' => 'Resources', 'values' => ['Shared with others', 'Guaranteed', 'All yours']],
                        ['label' => 'Control', 'values' => ['Limited', 'Root access', 'Full']],
                        ['label' => 'Speed', 'values' => ['Varies', 'Stable', 'Highest']],
                        ['label' => 'Price', 'values' => ['Cheapest', 'Medium', 'High']],
                        ['label' => 'Best for', 'values' => ['Small blogs', 'Most businesses and systems', 'Very heavy traffic']],
                    ],
                ],
                [
                    'type' => 'callout',
                    'kicker' => 'Information technology',
                    'headline' => 'LOWER COSTS',
                    'text' => 'No expensive servers or hardware to buy and maintain. You only pay for the capacity you use.',
                    'icon' => 'icon-[tabler--pig-money]',
                ],
                [
                    'type' => 'cards',
                    'title' => 'When should you choose a VPS?',
                    'items' => [
                        ['icon' => 'icon-[tabler--gauge]', 'title' => 'Your site is slow', 'text' => 'Traffic has outgrown shared hosting.'],
                        ['icon' => 'icon-[tabler--shopping-cart]', 'title' => 'Online store', 'text' => 'Payments and orders must never stop.'],
                        ['icon' => 'icon-[tabler--settings]', 'title' => 'Custom setup', 'text' => 'You need your own software or database.'],
                        ['icon' => 'icon-[tabler--shield-lock]', 'title' => 'Security', 'text' => 'Keep your data isolated and protected.'],
                    ],
                ],
            ],
        ],

        'qpay-integration' => [
            'title' => 'How do you connect QPay to a website?',
            'lead' => 'Taking payments by QR code and confirming them automatically is the simplest way to sell online.',
            'reading_time' => '4 minutes',
            'seo_description' => 'How to connect QPay QR payments to a website or online store: the payment flow, what you need and the benefits of automatic confirmation.',
            'blocks' => [
                [
                    'type' => 'flow',
                    'title' => 'How does a payment work?',
                    'steps' => [
                        ['title' => 'Order', 'text' => 'The customer confirms the cart'],
                        ['title' => 'Invoice', 'text' => 'The site creates an invoice with a QR code'],
                        ['title' => 'Payment', 'text' => 'The customer scans it in their banking app'],
                        ['title' => 'Notification', 'text' => 'The payment system notifies the site'],
                        ['title' => 'Confirmation', 'text' => 'The order is marked as paid automatically'],
                    ],
                ],
                [
                    'type' => 'tree',
                    'title' => 'What do you need?',
                    'nodes' => [
                        ['label' => 'Contract', 'text' => 'A merchant agreement with the payment provider'],
                        ['label' => 'API keys', 'text' => 'Your business username and secret key'],
                        ['label' => 'Server', 'text' => 'A server with HTTPS that can receive notifications'],
                        ['label' => 'Development', 'text' => 'Code that creates invoices and checks payments'],
                    ],
                    'result' => ['label' => 'Our part', 'text' => 'We handle all the technical work apart from the contract'],
                ],
                [
                    'type' => 'callout',
                    'kicker' => 'No manual checks',
                    'headline' => 'AUTOMATIC',
                    'text' => 'No more checking bank statements or asking whether a payment arrived. The system confirms it in seconds.',
                    'icon' => 'icon-[tabler--bolt]',
                ],
                [
                    'type' => 'cards',
                    'title' => 'What are the benefits?',
                    'items' => [
                        ['icon' => 'icon-[tabler--building-bank]', 'title' => 'Every bank', 'text' => 'Customers pay with their own banking app.'],
                        ['icon' => 'icon-[tabler--bolt]', 'title' => 'Instant', 'text' => 'Orders are confirmed as soon as payment arrives.'],
                        ['icon' => 'icon-[tabler--mood-smile]', 'title' => 'Easy to use', 'text' => 'No card details or sign-up required.'],
                        ['icon' => 'icon-[tabler--lock]', 'title' => 'Secure', 'text' => 'Card and account details never touch your site.'],
                    ],
                ],
            ],
        ],
    ],

];
