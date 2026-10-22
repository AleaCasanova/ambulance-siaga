/**
 * Ambulance 3D Vector Engine (360° Real Vehicle Simulation)
 * Ambulance Siaga - Realistic Driving Direction & Compass Heading
 */
(function(window) {
    'use strict';

    function shadeColor(hex, lum) {
        hex = String(hex).replace(/[^0-9a-f]/gi, '');
        if (hex.length < 6) hex = hex[0]+hex[0]+hex[1]+hex[1]+hex[2]+hex[2];
        lum = Math.max(-0.4, Math.min(0.35, lum));
        let rgb = '#';
        for (let i = 0; i < 3; i++) {
            let c = parseInt(hex.substr(i*2, 2), 16);
            c = Math.round(Math.min(Math.max(0, c + (c * lum)), 255)).toString(16);
            rgb += ('00' + c).substr(c.length);
        }
        return rgb;
    }

    function makeBox(minX, minY, minZ, maxX, maxY, maxZ, color, tags = {}) {
        return [
            // Front (+Z)
            { pts: [[minX,minY,maxZ],[maxX,minY,maxZ],[maxX,maxY,maxZ],[minX,maxY,maxZ]], normal: [0,0,1], color, ...tags, face: 'front' },
            // Back (-Z)
            { pts: [[maxX,minY,minZ],[minX,minY,minZ],[minX,maxY,minZ],[maxX,maxY,minZ]], normal: [0,0,-1], color, ...tags, face: 'back' },
            // Top (-Y)
            { pts: [[minX,minY,minZ],[maxX,minY,minZ],[maxX,minY,maxZ],[minX,minY,maxZ]], normal: [0,-1,0], color, ...tags, face: 'top' },
            // Bottom (+Y)
            { pts: [[minX,maxY,maxZ],[maxX,maxY,maxZ],[maxX,maxY,minZ],[minX,maxY,minZ]], normal: [0,1,0], color: '#1e293b', ...tags, face: 'bottom' },
            // Right (+X)
            { pts: [[maxX,minY,maxZ],[maxX,minY,minZ],[maxX,maxY,minZ],[maxX,maxY,maxZ]], normal: [1,0,0], color, ...tags, face: 'right' },
            // Left (-X)
            { pts: [[minX,minY,minZ],[minX,minY,maxZ],[minX,maxY,maxZ],[minX,maxY,minZ]], normal: [-1,0,0], color, ...tags, face: 'left' }
        ];
    }

    function buildAmbulancePolygons() {
        const polygons = [];

        // 1. Rear Medical Box (White Top + Red Bottom)
        // White upper box (length -2 to +26, width -14 to 14, height -20 to 0)
        polygons.push(...makeBox(-14, -20, -2, 14, 0, 26, '#ffffff', { section: 'rear_white' }));
        // Red lower stripe (height 0 to 6)
        polygons.push(...makeBox(-14, 0, -2, 14, 6, 26, '#dc2626', { section: 'rear_red' }));

        // 2. Front Driver Cabin (length -26 to -2, width -13.5 to 13.5)
        // Cabin lower red stripe
        polygons.push(...makeBox(-13.5, 0, -26, 13.5, 6, -2, '#dc2626', { section: 'cab_red' }));
        // Cabin hood top
        polygons.push(...makeBox(-13.5, -4, -26, 13.5, 0, -14, '#ffffff', { section: 'cab_hood' }));
        // Cabin roof
        polygons.push(...makeBox(-13.5, -14, -14, 13.5, -4, -2, '#ffffff', { section: 'cab_roof' }));

        // Slanted Windshield (faces forward towards -Z)
        polygons.push({
            pts: [[-13, -14, -14], [13, -14, -14], [13, -4, -25], [-13, -4, -25]],
            normal: [0, -0.65, -0.76],
            color: '#38bdf8',
            face: 'windshield',
            type: 'windshield'
        });

        // Cabin Side Windows (Left & Right)
        polygons.push({
            pts: [[-13.6, -13, -13], [-13.6, -13, -3], [-13.6, -5, -3], [-13.6, -5, -13]],
            normal: [-1, 0, 0],
            color: '#38bdf8',
            face: 'left',
            type: 'cabin_win'
        });
        polygons.push({
            pts: [[13.6, -13, -3], [13.6, -13, -13], [13.6, -5, -13], [13.6, -5, -3]],
            normal: [1, 0, 0],
            color: '#38bdf8',
            face: 'right',
            type: 'cabin_win'
        });

        // 3. Side Mirrors
        polygons.push(...makeBox(-16, -9, -15, -13.6, -6, -13, '#1e293b', { type: 'mirror' }));
        polygons.push(...makeBox(13.6, -9, -15, 16, -6, -13, '#1e293b', { type: 'mirror' }));

        // 4. Wheels (3D Tires with Silver Alloy Hubcaps)
        function addWheel(cx, cy, cz, isLeft) {
            const w = 4.5;
            const r = 5.2;
            polygons.push(...makeBox(cx - w/2, cy - r, cz - r, cx + w/2, cy + r, cz + r, '#0f172a', { type: 'wheel', isLeft }));
        }
        addWheel(-14.2, 6, -18, true);  // Front Left
        addWheel(14.2, 6, -18, false); // Front Right
        addWheel(-14.2, 6, 16, true);   // Rear Left
        addWheel(14.2, 6, 16, false);  // Rear Right

        // 5. Emergency Siren Bar on Roof (Red Left, Blue Right)
        polygons.push(...makeBox(-9, -25, -6, -1, -20, -2, '#ef4444', { type: 'siren_red' }));
        polygons.push(...makeBox(1, -25, -6, 9, -20, -2, '#3b82f6', { type: 'siren_blue' }));

        return polygons;
    }

    const AMBULANCE_POLYGONS = buildAmbulancePolygons();
    const LIGHT_DIR = [0.45, -0.85, -0.3];
    const len = Math.hypot(...LIGHT_DIR);
    LIGHT_DIR[0] /= len; LIGHT_DIR[1] /= len; LIGHT_DIR[2] /= len;

    /**
     * Calculates mathematical compass bearing in radians between two lat/lng coordinates.
     * Returns angle from North (0 = North, PI/2 = East, PI = South, -PI/2 = West).
     */
    function computeBearing(lat1, lng1, lat2, lng2) {
        const toRad = Math.PI / 180;
        const phi1 = lat1 * toRad;
        const phi2 = lat2 * toRad;
        const deltaLambda = (lng2 - lng1) * toRad;

        const y = Math.sin(deltaLambda) * Math.cos(phi2);
        const x = Math.cos(phi1) * Math.sin(phi2) - Math.sin(phi1) * Math.cos(phi2) * Math.cos(deltaLambda);
        return Math.atan2(y, x);
    }

    /**
     * Converts a compass bearing to the 3D model orientation angle.
     * Front of 3D car points forward along the road!
     */
    function bearingToModelAngle(bearingRad) {
        return bearingRad + Math.PI;
    }

    /**
     * Initializes a 3D Ambulance Engine on a <canvas> element.
     */
    function initAmbulance3DEngine(canvas, options = {}) {
        if (!canvas) return null;
        const ctx = canvas.getContext('2d');
        if (!ctx) return null;

        // Default: Do NOT auto-spin on road maps! Follow road direction.
        let isSpinning = options.autoSpin === true; 
        
        let initialAngle = Math.PI; // Default facing North (Up)
        if (options.destLat && options.destLng && options.lat && options.lng) {
            const b = computeBearing(options.lat, options.lng, options.destLat, options.destLng);
            initialAngle = bearingToModelAngle(b);
        } else if (options.initialBearing !== undefined) {
            initialAngle = bearingToModelAngle(options.initialBearing * Math.PI / 180);
        } else if (options.initialAngle !== undefined) {
            initialAngle = options.initialAngle * Math.PI / 180;
        }

        let currentAngle = initialAngle;
        let targetAngle = initialAngle;
        const pitch = (options.pitch || 28) * Math.PI / 180;
        const baseScale = options.scale || (canvas.width / 100);

        let lastLat = options.lat !== undefined ? options.lat : null;
        let lastLng = options.lng !== undefined ? options.lng : null;
        let isDriving = false;
        let driveTimer = 0;
        let flashTimer = Math.random() * 10;
        let radarPulse = 0;
        let isAlive = true;
        let animFrameId = null;

        // Allow manual drag to rotate for inspecting
        let isDragging = false;
        let lastMouseX = 0;
        const parentElem = canvas.parentElement || canvas;

        const onPointerDown = (e) => {
            isDragging = true;
            isSpinning = false;
            lastMouseX = e.clientX;
            try { parentElem.setPointerCapture(e.pointerId); } catch(err){}
        };
        const onPointerMove = (e) => {
            if (!isDragging) return;
            const dx = e.clientX - lastMouseX;
            lastMouseX = e.clientX;
            currentAngle += dx * 0.025;
            targetAngle = currentAngle;
        };
        const onPointerUp = () => { isDragging = false; };

        parentElem.addEventListener('pointerdown', onPointerDown);
        window.addEventListener('pointermove', onPointerMove);
        window.addEventListener('pointerup', onPointerUp);

        function render() {
            if (!isAlive || !document.body.contains(canvas)) {
                cleanup();
                return;
            }

            ctx.clearRect(0, 0, canvas.width, canvas.height);

            if (isSpinning) {
                currentAngle += 0.02;
                if (currentAngle > Math.PI * 2) currentAngle -= Math.PI * 2;
                targetAngle = currentAngle;
            } else if (!isDragging) {
                // Smoothly steer/interpolate towards targetAngle (shortest angular distance)
                let diff = (targetAngle - currentAngle) % (Math.PI * 2);
                if (diff < -Math.PI) diff += Math.PI * 2;
                if (diff > Math.PI) diff -= Math.PI * 2;
                currentAngle += diff * 0.14;
            }

            flashTimer += 0.16;
            const flashRed = Math.sin(flashTimer) > 0;
            radarPulse = (radarPulse + 0.02) % 1;

            driveTimer += 0.1;
            // Gentle suspension vibration while vehicle is in mission
            const bounceY = Math.sin(driveTimer) * 0.8 * (baseScale / 2.4);

            const cosY = Math.cos(currentAngle);
            const sinY = Math.sin(currentAngle);
            const cosX = Math.cos(pitch);
            const sinX = Math.sin(pitch);

            const cx = canvas.width / 2;
            const cy = canvas.height / 2 + (8 * (baseScale / 2.4)) + bounceY;

            // 1. Radar GPS Pulse Wave on Ground
            ctx.save();
            ctx.beginPath();
            const rSize = 34 * baseScale * (0.4 + radarPulse * 0.6);
            ctx.ellipse(cx, cy + (24 * baseScale * 0.45) - bounceY, rSize, rSize * 0.45, 0, 0, Math.PI * 2);
            ctx.strokeStyle = `rgba(14, 165, 233, ${Math.max(0, 0.75 - radarPulse * 0.75)})`;
            ctx.lineWidth = 2 * (baseScale / 2.4);
            ctx.stroke();
            ctx.restore();

            // 2. Ground Drop Shadow (Stays firmly on asphalt)
            ctx.save();
            ctx.beginPath();
            ctx.ellipse(cx, cy + (26 * baseScale * 0.45) - bounceY, 22 * baseScale, 11 * baseScale, 0, 0, Math.PI * 2);
            ctx.fillStyle = 'rgba(15, 23, 42, 0.45)';
            ctx.filter = 'blur(4px)';
            ctx.fill();
            ctx.restore();

            // 3. Project 3D Polygons
            const transformed = [];

            for (const poly of AMBULANCE_POLYGONS) {
                const screenPts = [];
                let avgZ = 0;

                for (const [x, y, z] of poly.pts) {
                    const sx = x * baseScale;
                    const sy = y * baseScale;
                    const sz = z * baseScale;

                    // Yaw rotation
                    const x1 = sx * cosY + sz * sinY;
                    const z1 = -sx * sinY + sz * cosY;
                    // Pitch rotation
                    const y2 = sy * cosX - z1 * sinX;
                    const z2 = sy * sinX + z1 * cosX;

                    screenPts.push([cx + x1, cy + y2]);
                    avgZ += z2;
                }
                avgZ /= poly.pts.length;

                const [nx, ny, nz] = poly.normal;
                const nx1 = nx * cosY + nz * sinY;
                const nz1 = -nx * sinY + nz * cosY;
                const ny2 = ny * cosX - nz1 * sinX;
                const nz2 = ny * sinX + nz1 * cosX;

                // Backface culling
                if (nz2 < 0.05 || poly.type === 'windshield') {
                    const dot = -(nx1 * LIGHT_DIR[0] + ny2 * LIGHT_DIR[1] + nz2 * LIGHT_DIR[2]);
                    const lum = (dot * 0.35);

                    let fillColor = shadeColor(poly.color, lum);

                    if (poly.type === 'siren_red') {
                        fillColor = flashRed ? '#ff1e1e' : '#7f1d1d';
                    } else if (poly.type === 'siren_blue') {
                        fillColor = !flashRed ? '#38bdf8' : '#0369a1';
                    } else if (poly.type === 'windshield' || poly.type === 'cabin_win') {
                        fillColor = shadeColor('#38bdf8', lum + 0.15);
                    }

                    transformed.push({
                        pts: screenPts,
                        z: avgZ,
                        fillColor,
                        poly,
                        normal: [nx1, ny2, nz2]
                    });
                }
            }

            // Painter's Algorithm: Sort by depth
            transformed.sort((a, b) => b.z - a.z);

            // Draw all visible faces
            for (const item of transformed) {
                ctx.beginPath();
                ctx.moveTo(item.pts[0][0], item.pts[0][1]);
                for (let i = 1; i < item.pts.length; i++) {
                    ctx.lineTo(item.pts[i][0], item.pts[i][1]);
                }
                ctx.closePath();

                ctx.fillStyle = item.fillColor;
                ctx.fill();
                ctx.strokeStyle = item.fillColor;
                ctx.lineWidth = 0.6;
                ctx.stroke();

                // Decal 1: Red Cross on White Body (Left, Right, Back Doors)
                if (item.poly.section === 'rear_white') {
                    const midX = (item.pts[0][0] + item.pts[2][0]) / 2;
                    const midY = (item.pts[0][1] + item.pts[2][1]) / 2;

                    if (['left', 'right', 'back'].includes(item.poly.face)) {
                        ctx.save();
                        // White circle emblem
                        ctx.beginPath();
                        ctx.arc(midX, midY, 7 * (baseScale / 2.4), 0, Math.PI * 2);
                        ctx.fillStyle = '#ffffff';
                        ctx.shadowColor = 'rgba(0,0,0,0.18)';
                        ctx.shadowBlur = 2;
                        ctx.fill();

                        // Red Cross symbol
                        ctx.fillStyle = '#dc2626';
                        const crossW = 8 * (baseScale / 2.4);
                        const thick = 2.6 * (baseScale / 2.4);
                        ctx.fillRect(midX - thick/2, midY - crossW/2, thick, crossW);
                        ctx.fillRect(midX - crossW/2, midY - thick/2, crossW, thick);
                        ctx.restore();
                    }
                }

                // Decal 2: Front Chrome Grille & Headlights
                if (item.poly.section === 'cab_red' && item.poly.face === 'front') {
                    ctx.save();
                    const midX = (item.pts[0][0] + item.pts[2][0]) / 2;
                    const topY = item.pts[0][1];
                    const grilleW = 20 * (baseScale / 2.4);
                    const grilleH = 6 * (baseScale / 2.4);

                    // Chrome Grille
                    ctx.fillStyle = '#1e293b';
                    ctx.fillRect(midX - grilleW/2, topY + 2, grilleW, grilleH);
                    ctx.fillStyle = '#cbd5e1';
                    ctx.fillRect(midX - grilleW/2 + 2, topY + 4, grilleW - 4, 1.2);

                    // Dual Glowing Headlights
                    ctx.fillStyle = '#fef08a';
                    ctx.shadowColor = '#facc15';
                    ctx.shadowBlur = 8;
                    const hRadius = 3 * (baseScale / 2.4);
                    ctx.beginPath();
                    ctx.arc((item.pts[0][0]*0.75 + item.pts[1][0]*0.25), topY + 5, hRadius, 0, Math.PI*2);
                    ctx.arc((item.pts[0][0]*0.25 + item.pts[1][0]*0.75), topY + 5, hRadius, 0, Math.PI*2);
                    ctx.fill();
                    ctx.restore();
                }

                // Decal 3: Wheel Alloy Hubcap
                if (item.poly.type === 'wheel') {
                    const midX = (item.pts[0][0] + item.pts[2][0]) / 2;
                    const midY = (item.pts[0][1] + item.pts[2][1]) / 2;
                    ctx.save();
                    ctx.fillStyle = '#94a3b8';
                    ctx.beginPath();
                    ctx.arc(midX, midY, 2.5 * (baseScale / 2.4), 0, Math.PI * 2);
                    ctx.fill();
                    ctx.restore();
                }

                // Decal 4: Siren Light Strobe Bloom
                if (item.poly.type === 'siren_red' && flashRed) {
                    ctx.save();
                    ctx.shadowColor = '#ef4444';
                    ctx.shadowBlur = 14;
                    ctx.fillStyle = '#ff2222';
                    ctx.fill();
                    ctx.restore();
                } else if (item.poly.type === 'siren_blue' && !flashRed) {
                    ctx.save();
                    ctx.shadowColor = '#38bdf8';
                    ctx.shadowBlur = 14;
                    ctx.fillStyle = '#60a5fa';
                    ctx.fill();
                    ctx.restore();
                }
            }

            animFrameId = requestAnimationFrame(render);
        }

        function cleanup() {
            isAlive = false;
            if (animFrameId) cancelAnimationFrame(animFrameId);
            parentElem.removeEventListener('pointerdown', onPointerDown);
            window.removeEventListener('pointermove', onPointerMove);
            window.removeEventListener('pointerup', onPointerUp);
        }

        render();

        return {
            /**
             * Sets exact model angle in degrees (0 = South, 90 = West, 180 = North, 270 = East)
             */
            setAngle: function(deg) {
                isSpinning = false;
                targetAngle = deg * Math.PI / 180;
            },
            /**
             * Sets compass heading in degrees (0 = North, 90 = East, 180 = South, 270 = West)
             * The car will face forward into this compass direction.
             */
            setCompassHeading: function(compassDeg) {
                isSpinning = false;
                const bearingRad = compassDeg * Math.PI / 180;
                targetAngle = bearingToModelAngle(bearingRad);
            },
            /**
             * Orients the vehicle to face directly towards target coordinates
             */
            setHeadingTowards: function(targetLat, targetLng) {
                if (lastLat === null || lastLng === null) return;
                const b = computeBearing(lastLat, lastLng, targetLat, targetLng);
                targetAngle = bearingToModelAngle(b);
                isSpinning = false;
            },
            /**
             * Aligns the vehicle along a road segment between start and next waypoints
             */
            setHeadingAlongRoad: function(startLat, startLng, nextLat, nextLng) {
                const b = computeBearing(startLat, startLng, nextLat, nextLng);
                targetAngle = bearingToModelAngle(b);
                isSpinning = false;
            },
            toggleSpin: function() {
                isSpinning = !isSpinning;
                return isSpinning;
            },
            setSpin: function(val) {
                isSpinning = val;
            },
            /**
             * Called whenever GPS updates. Calculates real movement vector and turns car forward!
             */
            updatePosition: function(newLat, newLng) {
                if (lastLat !== null && lastLng !== null) {
                    const distDelta = Math.hypot(newLat - lastLat, newLng - lastLng);
                    // Only update heading if moved meaningfully (> 1 meter)
                    if (distDelta > 0.00002) {
                        const bearing = computeBearing(lastLat, lastLng, newLat, newLng);
                        targetAngle = bearingToModelAngle(bearing);
                        isDriving = true;
                        isSpinning = false;
                    }
                }
                lastLat = newLat;
                lastLng = newLng;
            },
            destroy: cleanup
        };
    }

    /**
     * Helper to create a Leaflet 3D Ambulance Marker
     */
    function createLeafletAmbulance3DMarker(map, lat, lng, options = {}) {
        const id = 'amb_3d_' + Math.random().toString(36).substr(2, 9);
        const size = options.size || 58; // Display size in px

        const divIcon = L.divIcon({
            className: 'ambulance-3d-leaflet-icon',
            html: `
                <div class="ambulance-3d-pin-wrap" style="width:${size}px; height:${size}px; position:relative; display:flex; align-items:center; justify-content:center; cursor:grab;">
                    <canvas id="${id}" width="${size * 2}" height="${size * 2}" style="width:${size}px; height:${size}px; display:block;"></canvas>
                </div>
            `,
            iconSize: [size, size],
            iconAnchor: [size / 2, size / 2 + 6]
        });

        const marker = L.marker([lat, lng], {
            icon: divIcon,
            zIndexOffset: 1200,
            title: 'Ambulans Siaga 3D'
        }).addTo(map);

        setTimeout(() => {
            const canvas = document.getElementById(id);
            if (canvas) {
                marker.engine3D = initAmbulance3DEngine(canvas, {
                    ...options,
                    lat: lat,
                    lng: lng,
                    scale: (size * 2) / 100
                });
            }
        }, 60);

        return marker;
    }

    /**
     * Helper to get Leaflet 3D Hospital Icon (Isometric Building)
     */
    function getHospital3DIcon(options = {}) {
        const size = options.size || 52;
        const height = Math.round(size * 1.15);
        return L.divIcon({
            className: 'hospital-3d-leaflet-icon',
            html: `
                <div class="hospital-3d-pin-wrap" style="width:${size}px; height:${height}px; position:relative; display:flex; align-items:center; justify-content:center; cursor:pointer;">
                    <!-- Ground pulse beacon -->
                    <div style="position:absolute; bottom:0px; left:50%; transform:translateX(-50%); width:${size * 0.85}px; height:${size * 0.3}px; border-radius:50%; background:radial-gradient(ellipse, rgba(16, 185, 129, 0.4) 0%, rgba(16, 185, 129, 0) 70%); border:1.5px solid rgba(16, 185, 129, 0.6); pointer-events:none;"></div>
                    <!-- Ground asphalt shadow -->
                    <div style="position:absolute; bottom:2px; left:50%; transform:translateX(-50%); width:${size * 0.8}px; height:${size * 0.25}px; border-radius:50%; background:rgba(15, 23, 42, 0.45); filter:blur(3px); pointer-events:none;"></div>
                    <!-- 3D Isometric Hospital Building -->
                    <img src="/images/rumahsakit-3d.png" alt="Rumah Sakit 3D" style="width:100%; height:100%; object-fit:contain; filter:drop-shadow(0 6px 8px rgba(0,0,0,0.25)); position:relative; z-index:2; display:block;" />
                </div>
            `,
            iconSize: [size, height],
            iconAnchor: [size / 2, height - 4],
            popupAnchor: [0, -(height - 8)]
        });
    }

    function createLeafletHospital3DMarker(map, lat, lng, options = {}) {
        const icon = getHospital3DIcon(options);
        const marker = L.marker([lat, lng], {
            icon: icon,
            zIndexOffset: 950,
            title: options.title || 'Rumah Sakit Rujukan 3D'
        }).addTo(map);
        return marker;
    }

    /**
     * Helper to get Leaflet 3D Patient Location Pin Icon
     * Glossy Red 3D Pin (pure red teardrop with center hollow, pointing directly to location)
     */
    function getPatientPin3DIcon(options = {}) {
        const size = options.size || 32;
        const height = Math.round(size * 1.475);
        const pulseColor = options.pulseColor || 'rgba(239, 68, 68, 0.65)';
        const cursorStyle = options.draggable ? 'cursor:grab;' : 'cursor:pointer;';

        return L.divIcon({
            className: 'patient-3d-leaflet-icon',
            html: `
                <div class="patient-3d-pin-wrap" style="width:${size}px; height:${height}px; position:relative; display:flex; align-items:flex-end; justify-content:center; ${cursorStyle}">
                    <!-- Ground Radar Pulse Ring at Tip -->
                    <div style="position:absolute; bottom:-2px; left:50%; transform:translateX(-50%); width:${Math.round(size * 0.75)}px; height:${Math.round(size * 0.28)}px; border-radius:50%; background:radial-gradient(ellipse, ${pulseColor} 0%, rgba(239, 68, 68, 0) 70%); border:1px solid rgba(239, 68, 68, 0.75); pointer-events:none; animation: patientPinPulse 2.2s ease-in-out infinite;"></div>
                    <!-- Ground Contact Shadow at Tip -->
                    <div style="position:absolute; bottom:-1px; left:50%; transform:translateX(-50%); width:${Math.round(size * 0.42)}px; height:${Math.round(size * 0.16)}px; border-radius:50%; background:rgba(15, 23, 42, 0.45); filter:blur(1.5px); pointer-events:none;"></div>
                    <!-- 3D Patient Location Pin (Red Only) -->
                    <img src="/images/pin-pasien-3d.png" alt="Lokasi Pasien 3D" style="width:100%; height:100%; object-fit:contain; filter:drop-shadow(0 4px 6px rgba(0,0,0,0.3)); position:relative; z-index:2; display:block; pointer-events:none;" />
                </div>
            `,
            iconSize: [size, height],
            iconAnchor: [size / 2, height],
            popupAnchor: [0, -height - 2]
        });
    }

    function createLeafletPatient3DMarker(map, lat, lng, options = {}) {
        const icon = getPatientPin3DIcon(options);
        const marker = L.marker([lat, lng], {
            icon: icon,
            zIndexOffset: options.zIndexOffset || 1000,
            draggable: options.draggable || false,
            title: options.title || 'Lokasi Pasien 3D'
        }).addTo(map);
        return marker;
    }

    // Auto-inject CSS keyframes for 3D marker animations if in browser
    if (typeof document !== 'undefined' && !document.getElementById('ambulance-3d-pin-styles')) {
        const style = document.createElement('style');
        style.id = 'ambulance-3d-pin-styles';
        style.textContent = `
            @keyframes patientPinPulse {
                0% { transform: translateX(-50%) scale(0.85); opacity: 0.85; }
                50% { transform: translateX(-50%) scale(1.35); opacity: 0.15; }
                100% { transform: translateX(-50%) scale(0.85); opacity: 0.85; }
            }
            .patient-3d-leaflet-icon, .hospital-3d-leaflet-icon, .ambulance-3d-leaflet-icon {
                background: transparent !important;
                border: none !important;
            }
        `;
        document.head.appendChild(style);
    }

    // Export globally
    window.initAmbulance3DEngine = initAmbulance3DEngine;
    window.createLeafletAmbulance3DMarker = createLeafletAmbulance3DMarker;
    window.getHospital3DIcon = getHospital3DIcon;
    window.createLeafletHospital3DMarker = createLeafletHospital3DMarker;
    window.getPatientPin3DIcon = getPatientPin3DIcon;
    window.createLeafletPatient3DMarker = createLeafletPatient3DMarker;

})(window);
