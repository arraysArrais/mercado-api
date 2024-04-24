--
-- PostgreSQL database dump
--

-- Dumped from database version 16.0 (Debian 16.0-1.pgdg120+1)
-- Dumped by pg_dump version 16.0 (Debian 16.0-1.pgdg120+1)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: category; Type: TABLE; Schema: public; Owner: db_user
--

CREATE TABLE public.category (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    tax_percent numeric(10,2) NOT NULL
);


ALTER TABLE public.category OWNER TO db_user;

--
-- Name: category_id_seq; Type: SEQUENCE; Schema: public; Owner: db_user
--

CREATE SEQUENCE public.category_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.category_id_seq OWNER TO db_user;

--
-- Name: category_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: db_user
--

ALTER SEQUENCE public.category_id_seq OWNED BY public.category.id;


--
-- Name: item; Type: TABLE; Schema: public; Owner: db_user
--

CREATE TABLE public.item (
    price numeric(10,2) NOT NULL,
    name character varying(255) NOT NULL,
    description text,
    category_id bigint NOT NULL,
    codigo character varying NOT NULL,
    id character(36) NOT NULL
);


ALTER TABLE public.item OWNER TO db_user;

--
-- Name: item_category_id_seq; Type: SEQUENCE; Schema: public; Owner: db_user
--

CREATE SEQUENCE public.item_category_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.item_category_id_seq OWNER TO db_user;

--
-- Name: item_category_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: db_user
--

ALTER SEQUENCE public.item_category_id_seq OWNED BY public.item.category_id;


--
-- Name: transaction; Type: TABLE; Schema: public; Owner: db_user
--

CREATE TABLE public.transaction (
    id bigint NOT NULL,
    created_date timestamp with time zone,
    total numeric(10,2) NOT NULL
);


ALTER TABLE public.transaction OWNER TO db_user;

--
-- Name: transaction_id_seq; Type: SEQUENCE; Schema: public; Owner: db_user
--

CREATE SEQUENCE public.transaction_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.transaction_id_seq OWNER TO db_user;

--
-- Name: transaction_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: db_user
--

ALTER SEQUENCE public.transaction_id_seq OWNED BY public.transaction.id;


--
-- Name: transaction_item; Type: TABLE; Schema: public; Owner: db_user
--

CREATE TABLE public.transaction_item (
    transaction_id bigint NOT NULL,
    item_id character(36) NOT NULL
);


ALTER TABLE public.transaction_item OWNER TO db_user;

--
-- Name: transaction_item_transaction_id_seq; Type: SEQUENCE; Schema: public; Owner: db_user
--

CREATE SEQUENCE public.transaction_item_transaction_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.transaction_item_transaction_id_seq OWNER TO db_user;

--
-- Name: transaction_item_transaction_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: db_user
--

ALTER SEQUENCE public.transaction_item_transaction_id_seq OWNED BY public.transaction_item.transaction_id;


--
-- Name: category id; Type: DEFAULT; Schema: public; Owner: db_user
--

ALTER TABLE ONLY public.category ALTER COLUMN id SET DEFAULT nextval('public.category_id_seq'::regclass);


--
-- Name: item category_id; Type: DEFAULT; Schema: public; Owner: db_user
--

ALTER TABLE ONLY public.item ALTER COLUMN category_id SET DEFAULT nextval('public.item_category_id_seq'::regclass);


--
-- Name: transaction id; Type: DEFAULT; Schema: public; Owner: db_user
--

ALTER TABLE ONLY public.transaction ALTER COLUMN id SET DEFAULT nextval('public.transaction_id_seq'::regclass);


--
-- Data for Name: category; Type: TABLE DATA; Schema: public; Owner: db_user
--

COPY public.category (id, name, tax_percent) FROM stdin;
\.


--
-- Data for Name: item; Type: TABLE DATA; Schema: public; Owner: db_user
--

COPY public.item (price, name, description, category_id, codigo, id) FROM stdin;
\.


--
-- Data for Name: transaction; Type: TABLE DATA; Schema: public; Owner: db_user
--

COPY public.transaction (id, created_date, total) FROM stdin;
\.


--
-- Data for Name: transaction_item; Type: TABLE DATA; Schema: public; Owner: db_user
--

COPY public.transaction_item (transaction_id, item_id) FROM stdin;
\.


--
-- Name: category_id_seq; Type: SEQUENCE SET; Schema: public; Owner: db_user
--

SELECT pg_catalog.setval('public.category_id_seq', 31, true);


--
-- Name: item_category_id_seq; Type: SEQUENCE SET; Schema: public; Owner: db_user
--

SELECT pg_catalog.setval('public.item_category_id_seq', 1, false);


--
-- Name: transaction_id_seq; Type: SEQUENCE SET; Schema: public; Owner: db_user
--

SELECT pg_catalog.setval('public.transaction_id_seq', 39, true);


--
-- Name: transaction_item_transaction_id_seq; Type: SEQUENCE SET; Schema: public; Owner: db_user
--

SELECT pg_catalog.setval('public.transaction_item_transaction_id_seq', 1, false);


--
-- Name: category category_pk; Type: CONSTRAINT; Schema: public; Owner: db_user
--

ALTER TABLE ONLY public.category
    ADD CONSTRAINT category_pk PRIMARY KEY (id);


--
-- Name: item item_codigo_unique; Type: CONSTRAINT; Schema: public; Owner: db_user
--

ALTER TABLE ONLY public.item
    ADD CONSTRAINT item_codigo_unique UNIQUE (codigo);


--
-- Name: item item_pk; Type: CONSTRAINT; Schema: public; Owner: db_user
--

ALTER TABLE ONLY public.item
    ADD CONSTRAINT item_pk PRIMARY KEY (id);


--
-- Name: transaction transaction_pk; Type: CONSTRAINT; Schema: public; Owner: db_user
--

ALTER TABLE ONLY public.transaction
    ADD CONSTRAINT transaction_pk PRIMARY KEY (id);


--
-- Name: item category_fk; Type: FK CONSTRAINT; Schema: public; Owner: db_user
--

ALTER TABLE ONLY public.item
    ADD CONSTRAINT category_fk FOREIGN KEY (category_id) REFERENCES public.category(id);


--
-- Name: transaction_item transaction_item_item_fk; Type: FK CONSTRAINT; Schema: public; Owner: db_user
--

ALTER TABLE ONLY public.transaction_item
    ADD CONSTRAINT transaction_item_item_fk FOREIGN KEY (item_id) REFERENCES public.item(id);


--
-- Name: transaction_item transaction_item_transaction_fk; Type: FK CONSTRAINT; Schema: public; Owner: db_user
--

ALTER TABLE ONLY public.transaction_item
    ADD CONSTRAINT transaction_item_transaction_fk FOREIGN KEY (transaction_id) REFERENCES public.transaction(id);


--
-- PostgreSQL database dump complete
--

