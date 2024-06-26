import React, { useState } from 'react';

const FeedbackForm = () => {
    const [feedback, setFeedback] = useState('');
    const [name, setName] = useState('');
    const [email, setEmail] = useState('');
    const [rating, setRating] = useState(0);

    const handleSubmit = (e) => {
        e.preventDefault();
        // Handle form submission logic
        console.log('Feedback submitted:', { name, email, feedback, rating });
    };

    const formStyle = {
        maxWidth: '500px',
        margin: '50px auto',
        padding: '30px',
        borderRadius: '10px',
        boxShadow: '0 10px 20px rgba(0, 0, 0, 0.1)',
        fontFamily: 'Arial, sans-serif',
        backgroundColor: '#f9f9f9',
    };

    const inputStyle = {
        width: '100%',
        padding: '12px',
        margin: '8px 0 20px 0',
        borderRadius: '6px',
        border: '1px solid #ddd',
        boxSizing: 'border-box',
        transition: 'border-color 0.3s ease',
    };

    const inputFocusStyle = {
        borderColor: '#007bff',
    };

    const buttonStyle = {
        width: '100%',
        padding: '15px',
        margin: '20px 0 0 0',
        borderRadius: '6px',
        border: 'none',
        backgroundColor: '#007bff',
        color: '#fff',
        fontSize: '18px',
        cursor: 'pointer',
        transition: 'background-color 0.3s ease',
    };

    const buttonHoverStyle = {
        backgroundColor: '#0056b3',
    };

    const labelStyle = {
        marginBottom: '8px',
        fontWeight: 'bold',
        display: 'block',
        color: '#333',
    };

    const textareaStyle = {
        width: '100%',
        padding: '12px',
        margin: '8px 0 20px 0',
        borderRadius: '6px',
        border: '1px solid #ddd',
        boxSizing: 'border-box',
        minHeight: '120px',
        transition: 'border-color 0.3s ease',
    };

    const textareaFocusStyle = {
        borderColor: '#007bff',
    };

    const starStyle = {
        fontSize: '30px',
        color: '#ddd',
        cursor: 'pointer',
        transition: 'color 0.3s ease',
    };

    const activeStarStyle = {
        color: '#ffcc00',
    };

    return (
        <form style={formStyle} onSubmit={handleSubmit}>
            <h2 style={{ textAlign: 'center', color: '#333', marginBottom: '20px' }}>Feedback Form</h2>
            <div style={{ marginBottom: '15px' }}>
                <label style={labelStyle} htmlFor="name">Name</label>
                <input
                    type="text"
                    id="name"
                    value={name}
                    onChange={(e) => setName(e.target.value)}
                    style={inputStyle}
                    onFocus={(e) => e.target.style.borderColor = inputFocusStyle.borderColor}
                    onBlur={(e) => e.target.style.borderColor = inputStyle.borderColor}
                    required
                />
            </div>
            <div style={{ marginBottom: '15px' }}>
                <label style={labelStyle} htmlFor="email">Email</label>
                <input
                    type="email"
                    id="email"
                    value={email}
                    onChange={(e) => setEmail(e.target.value)}
                    style={inputStyle}
                    onFocus={(e) => e.target.style.borderColor = inputFocusStyle.borderColor}
                    onBlur={(e) => e.target.style.borderColor = inputStyle.borderColor}
                    required
                />
            </div>
            <div style={{ marginBottom: '15px' }}>
                <label style={labelStyle} htmlFor="feedback">Feedback</label>
                <textarea
                    id="feedback"
                    value={feedback}
                    onChange={(e) => setFeedback(e.target.value)}
                    style={textareaStyle}
                    onFocus={(e) => e.target.style.borderColor = textareaFocusStyle.borderColor}
                    onBlur={(e) => e.target.style.borderColor = textareaStyle.borderColor}
                    required
                />
            </div>
            <div style={{ marginBottom: '15px' }}>
                <label style={labelStyle}>Rating</label>
                {[1, 2, 3, 4, 5].map((star) => (
                    <span
                        key={star}
                        style={Object.assign({}, starStyle, star <= rating ? activeStarStyle : {})}
                        onClick={() => setRating(star)}
                        onMouseOver={(e) => e.target.style.color = activeStarStyle.color}
                        onMouseOut={(e) => e.target.style.color = star <= rating ? activeStarStyle.color : starStyle.color}
                    >
                        ★
                    </span>
                ))}
            </div>
            <button
                type="submit"
                style={buttonStyle}
                onMouseOver={(e) => e.target.style.backgroundColor = buttonHoverStyle.backgroundColor}
                onMouseOut={(e) => e.target.style.backgroundColor = buttonStyle.backgroundColor}
            >
                Submit
            </button>
        </form>
    );
};

export default FeedbackForm;
