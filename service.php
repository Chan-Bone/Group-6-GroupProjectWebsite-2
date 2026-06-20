<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prius - Our Services</title>
    <link rel="stylesheet" href="styles/unified.css">

    <style>
        .form-container {
            background-color: #ffffff; border: 2px solid #000000; border-radius: 8px;
            width: 90%; max-width: 850px; margin: 30px auto; padding: 30px; color: #000000; box-shadow: 0px 4px 15px rgba(0,0,0,0.5);
        }
        .services-grid {
            display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 25px; margin-top: 20px;
        }
        .service-card {
            background-color: #fafafa; border: 1px solid #000000; border-radius: 4px; padding: 25px;
            transition: transform 0.2s, box-shadow 0.2s; display: flex; flex-direction: column;
        }
        .service-card:hover {
            transform: translateY(-5px); box-shadow: 0px 5px 15px rgba(0,0,0,0.2); border-color: #003399;
        }
        .service-card h3 { color: #003399; margin-bottom: 15px; font-size: 1.3rem; border-bottom: 2px solid #000000; padding-bottom: 10px; }
        .service-card p { font-size: 1rem; line-height: 1.6; color: #333; }
    </style>
</head>
<body>

    <?php include 'header.inc'; ?>

    <section class="hero" style="height: auto; min-height: 100vh; padding-bottom: 50px;">
        <?php include 'nav.inc'; ?>

        <div class="form-container">
            <h2 style="font-size: 2.2rem; margin-bottom: 20px; text-align: center; color: #003399;">Our Digital IT Services</h2>
            <p style="text-align: center; margin-bottom: 40px; font-size: 1.1rem; color: #333;">
                Empowering the public sector through cutting-edge technology, secure digital infrastructure, and citizen-centric platforms.
            </p>

            <div class="services-grid">
                <div class="service-card">
                    <h3>E-Government Digital Platforms</h3>
                    <p>We create and set up unified citizen portals that turn old public services into web apps that work well on mobile devices. Our platforms make sure that all citizens can easily access, see, and use them.</p>
                </div>
                <div class="service-card">
                    <h3>Cybersecurity & Data Protection</h3>
                    <p>Our top priority is keeping sensitive public sector data safe. To protect the country's digital infrastructure from cyber threats, we use advanced threat detection, proactive vulnerability management, and strict encryption protocols.</p>
                </div>
                <div class="service-card">
                    <h3>Cloud Infrastructure Modernization</h3>
                    <p>Moving important government databases to scalable, high-performance cloud environments is what drives the "Cloud-First" initiative. This update makes sure that service is always available, data is processed faster, and resources are managed well.</p>
                </div>
            </div>
        </div>
    </section>

    <?php include 'footer.inc'; ?>
</body>
</html>