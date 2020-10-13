CREATE OR REPLACE FUNCTION trigger_set_timestamp()
RETURNS TRIGGER AS $$
BEGIN
  NEW.modified_at = NOW();
  RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TABLE clients (
    id INT GENERATED BY DEFAULT AS IDENTITY PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    phone VARCHAR(15) NOT NULL,
    address VARCHAR(255) NOT NULL,
    created_at timestamptz NOT NULL DEFAULT NOW(),
    modified_at timestamptz NOT NULL DEFAULT NOW()
);

CREATE TABLE products (
    code INT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    price VARCHAR(255) NOT NULL,
    created_at timestamptz NOT NULL DEFAULT NOW(),
    modified_at timestamptz NOT NULL DEFAULT NOW()
);

CREATE TABLE orders (
    id INT GENERATED BY DEFAULT AS IDENTITY PRIMARY KEY,
    client_id INT NOT NULL,
    total FLOAT NOT NULL,
    status VARCHAR(10) NOT NULL,
    date_order DATE,
    created_at timestamptz NOT NULL DEFAULT NOW(),
    modified_at timestamptz NOT NULL DEFAULT NOW(),
    FOREIGN KEY (client_id) REFERENCES clients(id)
);

CREATE TABLE order_lists (
    id INT GENERATED BY DEFAULT AS IDENTITY PRIMARY KEY,
    order_id INT NOT NULL,
    product_code INT NOT NULL,
    quantity INT NOT NULL,
    unitary_value FLOAT NOT NULL,
    amount FLOAT NOT NULL,
    created_at timestamptz NOT NULL DEFAULT NOW(),
    modified_at timestamptz NOT NULL DEFAULT NOW(),
    FOREIGN KEY (order_id) REFERENCES orders(id),
    FOREIGN KEY (product_code) REFERENCES products(code)
);

CREATE TRIGGER set_timestamp
BEFORE UPDATE ON clients
FOR EACH ROW
EXECUTE PROCEDURE trigger_set_timestamp();

CREATE TRIGGER set_timestamp
BEFORE UPDATE ON products
FOR EACH ROW
EXECUTE PROCEDURE trigger_set_timestamp();

CREATE TRIGGER set_timestamp
BEFORE UPDATE ON orders
FOR EACH ROW
EXECUTE PROCEDURE trigger_set_timestamp();

CREATE TRIGGER set_timestamp
BEFORE UPDATE ON order_lists
FOR EACH ROW
EXECUTE PROCEDURE trigger_set_timestamp();