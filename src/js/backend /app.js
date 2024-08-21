import React, { useState, useEffect } from 'react';
import apiFetch from '@wordpress/api-fetch';
import { format } from 'date-fns';

// Apply the nonce middleware to secure API requests
apiFetch.use(apiFetch.createNonceMiddleware(wpApiSettings.nonce));

function App() {
    const [showFormats, setShowFormats] = useState('');
    const [dateFormat, setDateFormat] = useState('');
    const [timeFormat, setTimeFormat] = useState('');

    useEffect(() => {
        apiFetch({ path: '/wp/v2/settings' }).then((response) => {
            if (response['your_show_formats'] !== undefined) {
                setShowFormats(response['your_show_formats']);
            }
            if (response['your_date_format']) {
                setDateFormat(response['your_date_format']);
            }
            if (response['your_time_format']) {
                setTimeFormat(response['your_time_format']);
            }
        }).catch((error) => {
            console.error('Error fetching settings:', error);
        });
    }, []);

    const saveSettings = () => {
        apiFetch({
            path: '/wp/v2/settings',
            method: 'POST',
            data: {
                'your_show_formats': showFormats,
                'your_date_format': dateFormat,
                'your_time_format': timeFormat,
            },
        }).then((response) => {
            console.log('Settings saved', response);
        }).catch((error) => {
            console.error('Error saving settings:', error);
        });
    };

    // Current date
    const now = new Date();

    const formatDate = (date, formatStr) => {
        // Map user-friendly formats to date-fns format strings
        const formatMap = {
            'F j, Y': 'MMMM d, yyyy', // Example: August 21, 2024
            'Y-m-d': 'yyyy-MM-dd',    // Example: 2024-08-21
            'm/d/Y': 'MM/dd/yyyy',    // Example: 08/21/2024
            'd/m/Y': 'dd/MM/yyyy',    // Example: 21/08/2024
        };
    
        // Retrieve the corresponding date-fns format string or fallback to the provided formatStr
        const dateFormat = formatMap[formatStr] || formatStr;
    
        try {
            // Return the formatted date
            return format(date, dateFormat);
        } catch (error) {
            console.error('Error formatting date:', error);
            return date.toString(); // Fallback if formatting fails
        }
    };

    return (
        <div>
            <h1>Date and Time Settings</h1>

            {/* Enable/Disable Formats */}
            <div>
                <label>
                    <input
                        type="radio"
                        value={true}
                        checked={showFormats === true}
                        onChange={() => setShowFormats(true)}
                    />
                    Enable Date and Time Format
                </label><br />
                <label>
                    <input
                        type="radio"
                        value={false}
                        checked={showFormats === false}
                        onChange={() => setShowFormats(false)}
                    />
                    Disable Date and Time Format
                </label>
            </div>

            {showFormats && (
                <>
                    {/* Date Format Options */}
                    <div>
                        <h2>Date Format</h2>
                        <label>
                            <input
                                type="radio"
                                value="F j, Y"
                                checked={dateFormat === 'F j, Y'}
                                onChange={(e) => setDateFormat(e.target.value)}
                            />
                            {formatDate(now, 'F j, Y')}
                        </label><br />
                        <label>
                            <input
                                type="radio"
                                value="Y-m-d"
                                checked={dateFormat === 'Y-m-d'}
                                onChange={(e) => setDateFormat(e.target.value)}
                            />
                            {formatDate(now, 'Y-m-d')}
                        </label><br />
                        <label>
                            <input
                                type="radio"
                                value="m/d/Y"
                                checked={dateFormat === 'm/d/Y'}
                                onChange={(e) => setDateFormat(e.target.value)}
                            />
                            {formatDate(now, 'm/d/Y')}
                        </label><br />
                        <label>
                            <input
                                type="radio"
                                value="d/m/Y"
                                checked={dateFormat === 'd/m/Y'}
                                onChange={(e) => setDateFormat(e.target.value)}
                            />
                            {formatDate(now, 'd/m/Y')}
                        </label><br />
                        <label>
                            <input
                                type="radio"
                                value="custom"
                                checked={['F j, Y', 'Y-m-d', 'm/d/Y', 'd/m/Y'].indexOf(dateFormat) === -1}
                                onChange={() => setDateFormat('')}
                            />
                            Custom:
                            <input
                                type="text"
                                value={dateFormat}
                                onChange={(e) => setDateFormat(e.target.value)}
                                disabled={['F j, Y', 'Y-m-d', 'm/d/Y', 'd/m/Y'].includes(dateFormat)}
                            />
                        </label>
                    </div>

                    {/* Time Format Options */}
                    <div>
                        <h2>Time Format</h2>
                        <label>
                            <input
                                type="radio"
                                value="g:i a"
                                checked={timeFormat === 'g:i a'}
                                onChange={(e) => setTimeFormat(e.target.value)}
                            />
                            {format(now, 'h:mm a')}
                        </label><br />
                        <label>
                            <input
                                type="radio"
                                value="g:i A"
                                checked={timeFormat === 'g:i A'}
                                onChange={(e) => setTimeFormat(e.target.value)}
                            />
                            {format(now, 'h:mm a')}
                        </label><br />
                        <label>
                            <input
                                type="radio"
                                value="H:i"
                                checked={timeFormat === 'H:i'}
                                onChange={(e) => setTimeFormat(e.target.value)}
                            />
                            {format(now, 'HH:mm')}
                        </label><br />
                        <label>
                            <input
                                type="radio"
                                value="custom"
                                checked={['g:i a', 'g:i A', 'H:i'].indexOf(timeFormat) === -1}
                                onChange={() => setTimeFormat('')}
                            />
                            Custom:
                            <input
                                type="text"
                                value={timeFormat}
                                onChange={(e) => setTimeFormat(e.target.value)}
                                disabled={['g:i a', 'g:i A', 'H:i'].includes(timeFormat)}
                            />
                        </label>
                    </div>
                </>
            )}

            {/* Save Button */}
            <button onClick={saveSettings}>Save Settings</button>
        </div>
    );
}

export default App;
