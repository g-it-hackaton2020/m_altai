--
-- PostgreSQL database dump
--

-- Dumped from database version 11.2
-- Dumped by pg_dump version 11.3

-- Started on 2020-06-06 13:35:54

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

--
-- TOC entry 3001 (class 1262 OID 25076)
-- Name: m_altai; Type: DATABASE; Schema: -; Owner: postgres
--

CREATE DATABASE m_altai WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'ru-RU@icu' LC_CTYPE = 'ru-RU';


ALTER DATABASE m_altai OWNER TO postgres;

\connect m_altai

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

SET default_with_oids = false;

--
-- TOC entry 199 (class 1259 OID 25092)
-- Name: community_group; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.community_group (
    id uuid NOT NULL,
    lead_id uuid NOT NULL,
    community_name character varying(255) NOT NULL,
    description text NOT NULL,
    created_at timestamp(0) with time zone NOT NULL,
    updated_at timestamp(0) with time zone NOT NULL,
    deleted_at timestamp(0) with time zone DEFAULT NULL::timestamp with time zone
);


ALTER TABLE public.community_group OWNER TO postgres;

--
-- TOC entry 3002 (class 0 OID 0)
-- Dependencies: 199
-- Name: COLUMN community_group.id; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.community_group.id IS '(DC2Type:uuid)';


--
-- TOC entry 3003 (class 0 OID 0)
-- Dependencies: 199
-- Name: COLUMN community_group.lead_id; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.community_group.lead_id IS '(DC2Type:uuid)';


--
-- TOC entry 200 (class 1259 OID 25102)
-- Name: community_group_people; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.community_group_people (
    community_group_id uuid NOT NULL,
    people_id uuid NOT NULL
);


ALTER TABLE public.community_group_people OWNER TO postgres;

--
-- TOC entry 3004 (class 0 OID 0)
-- Dependencies: 200
-- Name: COLUMN community_group_people.community_group_id; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.community_group_people.community_group_id IS '(DC2Type:uuid)';


--
-- TOC entry 3005 (class 0 OID 0)
-- Dependencies: 200
-- Name: COLUMN community_group_people.people_id; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.community_group_people.people_id IS '(DC2Type:uuid)';


--
-- TOC entry 208 (class 1259 OID 25222)
-- Name: doc_stad; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.doc_stad (
    id character varying(255) NOT NULL,
    name character varying(255) NOT NULL
);


ALTER TABLE public.doc_stad OWNER TO postgres;

--
-- TOC entry 207 (class 1259 OID 25217)
-- Name: document_num; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.document_num (
    id integer NOT NULL
);


ALTER TABLE public.document_num OWNER TO postgres;

--
-- TOC entry 206 (class 1259 OID 25215)
-- Name: document_num_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.document_num_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.document_num_id_seq OWNER TO postgres;

--
-- TOC entry 204 (class 1259 OID 25171)
-- Name: initiative; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.initiative (
    id uuid NOT NULL,
    initiative_type_id uuid NOT NULL,
    autor_id uuid NOT NULL,
    name character varying(255) NOT NULL,
    description text NOT NULL,
    created_at timestamp(0) with time zone NOT NULL,
    updated_at timestamp(0) with time zone NOT NULL,
    deleted_at timestamp(0) with time zone DEFAULT NULL::timestamp with time zone,
    num integer,
    stad_id character varying(255) DEFAULT NULL::character varying,
    community_group_id uuid
);


ALTER TABLE public.initiative OWNER TO postgres;

--
-- TOC entry 3006 (class 0 OID 0)
-- Dependencies: 204
-- Name: COLUMN initiative.id; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.initiative.id IS '(DC2Type:uuid)';


--
-- TOC entry 3007 (class 0 OID 0)
-- Dependencies: 204
-- Name: COLUMN initiative.initiative_type_id; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.initiative.initiative_type_id IS '(DC2Type:uuid)';


--
-- TOC entry 3008 (class 0 OID 0)
-- Dependencies: 204
-- Name: COLUMN initiative.autor_id; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.initiative.autor_id IS '(DC2Type:uuid)';


--
-- TOC entry 3009 (class 0 OID 0)
-- Dependencies: 204
-- Name: COLUMN initiative.community_group_id; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.initiative.community_group_id IS '(DC2Type:uuid)';


--
-- TOC entry 205 (class 1259 OID 25182)
-- Name: initiative_people; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.initiative_people (
    initiative_id uuid NOT NULL,
    people_id uuid NOT NULL
);


ALTER TABLE public.initiative_people OWNER TO postgres;

--
-- TOC entry 3010 (class 0 OID 0)
-- Dependencies: 205
-- Name: COLUMN initiative_people.initiative_id; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.initiative_people.initiative_id IS '(DC2Type:uuid)';


--
-- TOC entry 3011 (class 0 OID 0)
-- Dependencies: 205
-- Name: COLUMN initiative_people.people_id; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.initiative_people.people_id IS '(DC2Type:uuid)';


--
-- TOC entry 197 (class 1259 OID 25077)
-- Name: migration_versions; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.migration_versions (
    version character varying(14) NOT NULL,
    executed_at timestamp(0) without time zone NOT NULL
);


ALTER TABLE public.migration_versions OWNER TO postgres;

--
-- TOC entry 3012 (class 0 OID 0)
-- Dependencies: 197
-- Name: COLUMN migration_versions.executed_at; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.migration_versions.executed_at IS '(DC2Type:datetime_immutable)';


--
-- TOC entry 198 (class 1259 OID 25082)
-- Name: people; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.people (
    id uuid NOT NULL,
    fam character varying(255) NOT NULL,
    im character varying(255) NOT NULL,
    ot character varying(255) DEFAULT NULL::character varying,
    birth_date date NOT NULL,
    sex boolean NOT NULL,
    email character varying(255) NOT NULL,
    address character varying(255) NOT NULL,
    created_at timestamp(0) with time zone NOT NULL,
    updated_at timestamp(0) with time zone NOT NULL,
    deleted_at timestamp(0) with time zone DEFAULT NULL::timestamp with time zone
);


ALTER TABLE public.people OWNER TO postgres;

--
-- TOC entry 3013 (class 0 OID 0)
-- Dependencies: 198
-- Name: COLUMN people.id; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.people.id IS '(DC2Type:uuid)';


--
-- TOC entry 201 (class 1259 OID 25126)
-- Name: petition; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.petition (
    id uuid NOT NULL,
    petition_type_id uuid NOT NULL,
    autor_id uuid NOT NULL,
    name character varying(255) NOT NULL,
    description text NOT NULL,
    created_at timestamp(0) with time zone NOT NULL,
    updated_at timestamp(0) with time zone NOT NULL,
    deleted_at timestamp(0) with time zone DEFAULT NULL::timestamp with time zone,
    num integer,
    stad_id character varying(255) DEFAULT NULL::character varying,
    community_group_id uuid
);


ALTER TABLE public.petition OWNER TO postgres;

--
-- TOC entry 3014 (class 0 OID 0)
-- Dependencies: 201
-- Name: COLUMN petition.id; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.petition.id IS '(DC2Type:uuid)';


--
-- TOC entry 3015 (class 0 OID 0)
-- Dependencies: 201
-- Name: COLUMN petition.petition_type_id; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.petition.petition_type_id IS '(DC2Type:uuid)';


--
-- TOC entry 3016 (class 0 OID 0)
-- Dependencies: 201
-- Name: COLUMN petition.autor_id; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.petition.autor_id IS '(DC2Type:uuid)';


--
-- TOC entry 3017 (class 0 OID 0)
-- Dependencies: 201
-- Name: COLUMN petition.community_group_id; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.petition.community_group_id IS '(DC2Type:uuid)';


--
-- TOC entry 202 (class 1259 OID 25137)
-- Name: petition_people; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.petition_people (
    petition_id uuid NOT NULL,
    people_id uuid NOT NULL
);


ALTER TABLE public.petition_people OWNER TO postgres;

--
-- TOC entry 3018 (class 0 OID 0)
-- Dependencies: 202
-- Name: COLUMN petition_people.petition_id; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.petition_people.petition_id IS '(DC2Type:uuid)';


--
-- TOC entry 3019 (class 0 OID 0)
-- Dependencies: 202
-- Name: COLUMN petition_people.people_id; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.petition_people.people_id IS '(DC2Type:uuid)';


--
-- TOC entry 203 (class 1259 OID 25146)
-- Name: petition_type; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.petition_type (
    id uuid NOT NULL,
    name character varying(255) NOT NULL,
    code_type integer NOT NULL
);


ALTER TABLE public.petition_type OWNER TO postgres;

--
-- TOC entry 3020 (class 0 OID 0)
-- Dependencies: 203
-- Name: COLUMN petition_type.id; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.petition_type.id IS '(DC2Type:uuid)';


--
-- TOC entry 210 (class 1259 OID 25296)
-- Name: user; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."user" (
    id integer NOT NULL,
    email character varying(180) NOT NULL,
    roles json NOT NULL,
    password character varying(255) NOT NULL,
    people_id uuid
);


ALTER TABLE public."user" OWNER TO postgres;

--
-- TOC entry 3021 (class 0 OID 0)
-- Dependencies: 210
-- Name: COLUMN "user".people_id; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public."user".people_id IS '(DC2Type:uuid)';


--
-- TOC entry 209 (class 1259 OID 25294)
-- Name: user_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.user_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.user_id_seq OWNER TO postgres;

--
-- TOC entry 2984 (class 0 OID 25092)
-- Dependencies: 199
-- Data for Name: community_group; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.community_group (id, lead_id, community_name, description, created_at, updated_at, deleted_at) FROM stdin;
dbdb5086-2d8e-40ab-895b-f368d627ba1e	64104570-6b2c-4862-a87c-02a2d532311e	Cjj,otcndj sdfsdkj	sdfskd fskdfh ksjdhf s	2020-06-06 09:40:59+03	2020-06-06 09:40:59+03	\N
0f04b9dd-bc5f-4e3e-bceb-2fe56ee20dbd	64104570-6b2c-4862-a87c-02a2d532311e	Сообщество по району4	ыаваывьатиыв ываи ыа	2020-06-06 09:41:33+03	2020-06-06 09:41:33+03	\N
\.


--
-- TOC entry 2985 (class 0 OID 25102)
-- Dependencies: 200
-- Data for Name: community_group_people; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.community_group_people (community_group_id, people_id) FROM stdin;
\.


--
-- TOC entry 2993 (class 0 OID 25222)
-- Dependencies: 208
-- Data for Name: doc_stad; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.doc_stad (id, name) FROM stdin;
draft	Черновик
sended	Отправлена
review	На рассмотрении
accept	Принята к исполнению
reject	Отклонена
compliat	Завершена
\.


--
-- TOC entry 2992 (class 0 OID 25217)
-- Dependencies: 207
-- Data for Name: document_num; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.document_num (id) FROM stdin;
1
2
3
4
5
6
7
8
9
10
11
12
13
\.


--
-- TOC entry 2989 (class 0 OID 25171)
-- Dependencies: 204
-- Data for Name: initiative; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.initiative (id, initiative_type_id, autor_id, name, description, created_at, updated_at, deleted_at, num, stad_id, community_group_id) FROM stdin;
e5dc9cdf-d28a-4db3-bae8-6d054c3eee62	19df7d83-3330-41d0-ab17-730866c59447	64104570-6b2c-4862-a87c-02a2d532311e	Инициатива 2020-06/00000010	kjdshfkjsdbgdh gsdg dsg s	2020-06-06 09:01:14+03	2020-06-06 09:01:14+03	\N	10	draft	\N
cff01a44-0376-4a48-884a-793cb3a79d86	19df7d83-3330-41d0-ab17-730866c59447	64104570-6b2c-4862-a87c-02a2d532311e	Инициатива 2020-06/00000007	vxccxvxcvx v	2020-06-06 07:45:53+03	2020-06-06 07:45:53+03	\N	7	review	\N
0a56ce86-a663-48c5-b20a-a2faea872813	27080646-8988-4aef-8a87-a32fd0651b07	64104570-6b2c-4862-a87c-02a2d532311e	Инициатива 2020-06/00000011	аолрыа пывпрывдлпр ырпды ыщпрдыв ды	2020-06-06 09:06:58+03	2020-06-06 11:50:54+03	\N	11	draft	0f04b9dd-bc5f-4e3e-bceb-2fe56ee20dbd
1d783938-d606-4827-b8f3-42c386804214	27080646-8988-4aef-8a87-a32fd0651b07	64104570-6b2c-4862-a87c-02a2d532311e	Инициатива 2020-06/00000013	jxkdkj sdkjfhskjhfjhds kf	2020-06-06 10:36:15+03	2020-06-06 11:51:12+03	\N	13	draft	dbdb5086-2d8e-40ab-895b-f368d627ba1e
\.


--
-- TOC entry 2990 (class 0 OID 25182)
-- Dependencies: 205
-- Data for Name: initiative_people; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.initiative_people (initiative_id, people_id) FROM stdin;
0a56ce86-a663-48c5-b20a-a2faea872813	64104570-6b2c-4862-a87c-02a2d532311e
\.


--
-- TOC entry 2982 (class 0 OID 25077)
-- Dependencies: 197
-- Data for Name: migration_versions; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.migration_versions (version, executed_at) FROM stdin;
20200603154539	2020-06-05 18:17:40
20200603161024	2020-06-05 18:17:41
20200605100726	2020-06-05 18:17:41
20200605131028	2020-06-05 18:17:42
20200605135909	2020-06-05 18:17:42
20200605173608	2020-06-05 18:17:42
20200605192336	2020-06-05 19:26:09
20200605211731	2020-06-05 22:10:20
20200605224535	2020-06-05 22:46:12
20200606052525	2020-06-06 05:46:47
20200606055133	2020-06-06 05:52:45
20200606055606	2020-06-06 05:56:15
20200606063732	2020-06-06 06:38:20
20200606065153	2020-06-06 06:53:12
20200606070049	2020-06-06 07:02:23
20200606083025	2020-06-06 08:39:21
20200606100814	2020-06-06 10:19:42
\.


--
-- TOC entry 2983 (class 0 OID 25082)
-- Dependencies: 198
-- Data for Name: people; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.people (id, fam, im, ot, birth_date, sex, email, address, created_at, updated_at, deleted_at) FROM stdin;
64104570-6b2c-4862-a87c-02a2d532311e	Иванов	Иван	Иванович	1984-03-01	t	Test@t.co	dfsdfsdf	2020-06-05 23:05:10+03	2020-06-05 23:05:10+03	\N
\.


--
-- TOC entry 2986 (class 0 OID 25126)
-- Dependencies: 201
-- Data for Name: petition; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.petition (id, petition_type_id, autor_id, name, description, created_at, updated_at, deleted_at, num, stad_id, community_group_id) FROM stdin;
eda15d08-e985-403a-a2cf-8b07a2110bba	19df7d83-3330-41d0-ab17-730866c59447	64104570-6b2c-4862-a87c-02a2d532311e	Обращение 2020-06/00000009	dsfsdssdf sdfsf	2020-06-06 08:57:04+03	2020-06-06 08:57:04+03	\N	9	draft	\N
ba6532bb-47be-4f45-bfe3-355305823127	19df7d83-3330-41d0-ab17-730866c59447	64104570-6b2c-4862-a87c-02a2d532311e	Обращение 2020-06/00000006	sdfsdkjfskjdhfks kshfkhsdf	2020-06-06 07:42:33+03	2020-06-06 07:42:33+03	\N	6	draft	\N
c7c2628d-09a7-4b80-a5e2-58631f525537	19df7d83-3330-41d0-ab17-730866c59447	64104570-6b2c-4862-a87c-02a2d532311e	Обращение 2020-06/00000008	vccbvcb cvb	2020-06-06 07:48:23+03	2020-06-06 07:48:23+03	\N	8	sended	\N
ad935531-4f82-4a91-94e6-341be7631bac	19df7d83-3330-41d0-ab17-730866c59447	64104570-6b2c-4862-a87c-02a2d532311e	Обращение 2020-06/00000012	kh xkdfjhsdk jfh	2020-06-06 10:31:09+03	2020-06-06 10:31:09+03	\N	12	draft	0f04b9dd-bc5f-4e3e-bceb-2fe56ee20dbd
\.


--
-- TOC entry 2987 (class 0 OID 25137)
-- Dependencies: 202
-- Data for Name: petition_people; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.petition_people (petition_id, people_id) FROM stdin;
\.


--
-- TOC entry 2988 (class 0 OID 25146)
-- Dependencies: 203
-- Data for Name: petition_type; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.petition_type (id, name, code_type) FROM stdin;
19df7d83-3330-41d0-ab17-730866c59447	Индивидуальное	1
27080646-8988-4aef-8a87-a32fd0651b07	Коллективное	2
\.


--
-- TOC entry 2995 (class 0 OID 25296)
-- Dependencies: 210
-- Data for Name: user; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public."user" (id, email, roles, password, people_id) FROM stdin;
\.


--
-- TOC entry 3022 (class 0 OID 0)
-- Dependencies: 206
-- Name: document_num_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.document_num_id_seq', 13, true);


--
-- TOC entry 3023 (class 0 OID 0)
-- Dependencies: 209
-- Name: user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.user_id_seq', 1, false);


--
-- TOC entry 2811 (class 2606 OID 25108)
-- Name: community_group_people community_group_people_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.community_group_people
    ADD CONSTRAINT community_group_people_pkey PRIMARY KEY (community_group_id, people_id);


--
-- TOC entry 2808 (class 2606 OID 25100)
-- Name: community_group community_group_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.community_group
    ADD CONSTRAINT community_group_pkey PRIMARY KEY (id);


--
-- TOC entry 2839 (class 2606 OID 25229)
-- Name: doc_stad doc_stad_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.doc_stad
    ADD CONSTRAINT doc_stad_pkey PRIMARY KEY (id);


--
-- TOC entry 2837 (class 2606 OID 25221)
-- Name: document_num document_num_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.document_num
    ADD CONSTRAINT document_num_pkey PRIMARY KEY (id);


--
-- TOC entry 2835 (class 2606 OID 25188)
-- Name: initiative_people initiative_people_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.initiative_people
    ADD CONSTRAINT initiative_people_pkey PRIMARY KEY (initiative_id, people_id);


--
-- TOC entry 2831 (class 2606 OID 25179)
-- Name: initiative initiative_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.initiative
    ADD CONSTRAINT initiative_pkey PRIMARY KEY (id);


--
-- TOC entry 2804 (class 2606 OID 25081)
-- Name: migration_versions migration_versions_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.migration_versions
    ADD CONSTRAINT migration_versions_pkey PRIMARY KEY (version);


--
-- TOC entry 2806 (class 2606 OID 25091)
-- Name: people people_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.people
    ADD CONSTRAINT people_pkey PRIMARY KEY (id);


--
-- TOC entry 2823 (class 2606 OID 25143)
-- Name: petition_people petition_people_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.petition_people
    ADD CONSTRAINT petition_people_pkey PRIMARY KEY (petition_id, people_id);


--
-- TOC entry 2819 (class 2606 OID 25134)
-- Name: petition petition_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.petition
    ADD CONSTRAINT petition_pkey PRIMARY KEY (id);


--
-- TOC entry 2825 (class 2606 OID 25150)
-- Name: petition_type petition_type_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.petition_type
    ADD CONSTRAINT petition_type_pkey PRIMARY KEY (id);


--
-- TOC entry 2843 (class 2606 OID 25303)
-- Name: user user_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."user"
    ADD CONSTRAINT user_pkey PRIMARY KEY (id);


--
-- TOC entry 2809 (class 1259 OID 25101)
-- Name: idx_16b03e8155458d; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_16b03e8155458d ON public.community_group USING btree (lead_id);


--
-- TOC entry 2820 (class 1259 OID 25145)
-- Name: idx_7fbcd8683147c936; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_7fbcd8683147c936 ON public.petition_people USING btree (people_id);


--
-- TOC entry 2821 (class 1259 OID 25144)
-- Name: idx_7fbcd868aec7d346; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_7fbcd868aec7d346 ON public.petition_people USING btree (petition_id);


--
-- TOC entry 2812 (class 1259 OID 25110)
-- Name: idx_a4810a693147c936; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_a4810a693147c936 ON public.community_group_people USING btree (people_id);


--
-- TOC entry 2813 (class 1259 OID 25109)
-- Name: idx_a4810a69c121c60; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_a4810a69c121c60 ON public.community_group_people USING btree (community_group_id);


--
-- TOC entry 2832 (class 1259 OID 25190)
-- Name: idx_b938fd13147c936; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_b938fd13147c936 ON public.initiative_people USING btree (people_id);


--
-- TOC entry 2833 (class 1259 OID 25189)
-- Name: idx_b938fd1ab7d9771; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_b938fd1ab7d9771 ON public.initiative_people USING btree (initiative_id);


--
-- TOC entry 2826 (class 1259 OID 25181)
-- Name: idx_e115defe14d45bbe; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_e115defe14d45bbe ON public.initiative USING btree (autor_id);


--
-- TOC entry 2827 (class 1259 OID 25243)
-- Name: idx_e115defe59497894; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_e115defe59497894 ON public.initiative USING btree (stad_id);


--
-- TOC entry 2828 (class 1259 OID 25287)
-- Name: idx_e115defec121c60; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_e115defec121c60 ON public.initiative USING btree (community_group_id);


--
-- TOC entry 2829 (class 1259 OID 25180)
-- Name: idx_e115defee6b66ec9; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_e115defee6b66ec9 ON public.initiative USING btree (initiative_type_id);


--
-- TOC entry 2814 (class 1259 OID 25136)
-- Name: idx_ff598b0314d45bbe; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_ff598b0314d45bbe ON public.petition USING btree (autor_id);


--
-- TOC entry 2815 (class 1259 OID 25135)
-- Name: idx_ff598b03547f4ab6; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_ff598b03547f4ab6 ON public.petition USING btree (petition_type_id);


--
-- TOC entry 2816 (class 1259 OID 25236)
-- Name: idx_ff598b0359497894; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_ff598b0359497894 ON public.petition USING btree (stad_id);


--
-- TOC entry 2817 (class 1259 OID 25293)
-- Name: idx_ff598b03c121c60; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_ff598b03c121c60 ON public.petition USING btree (community_group_id);


--
-- TOC entry 2840 (class 1259 OID 25311)
-- Name: uniq_8d93d6493147c936; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX uniq_8d93d6493147c936 ON public."user" USING btree (people_id);


--
-- TOC entry 2841 (class 1259 OID 25304)
-- Name: uniq_8d93d649e7927c74; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX uniq_8d93d649e7927c74 ON public."user" USING btree (email);


--
-- TOC entry 2844 (class 2606 OID 25111)
-- Name: community_group fk_16b03e8155458d; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.community_group
    ADD CONSTRAINT fk_16b03e8155458d FOREIGN KEY (lead_id) REFERENCES public.people(id);


--
-- TOC entry 2852 (class 2606 OID 25166)
-- Name: petition_people fk_7fbcd8683147c936; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.petition_people
    ADD CONSTRAINT fk_7fbcd8683147c936 FOREIGN KEY (people_id) REFERENCES public.people(id) ON DELETE CASCADE;


--
-- TOC entry 2851 (class 2606 OID 25161)
-- Name: petition_people fk_7fbcd868aec7d346; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.petition_people
    ADD CONSTRAINT fk_7fbcd868aec7d346 FOREIGN KEY (petition_id) REFERENCES public.petition(id) ON DELETE CASCADE;


--
-- TOC entry 2859 (class 2606 OID 25306)
-- Name: user fk_8d93d6493147c936; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."user"
    ADD CONSTRAINT fk_8d93d6493147c936 FOREIGN KEY (people_id) REFERENCES public.people(id);


--
-- TOC entry 2846 (class 2606 OID 25121)
-- Name: community_group_people fk_a4810a693147c936; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.community_group_people
    ADD CONSTRAINT fk_a4810a693147c936 FOREIGN KEY (people_id) REFERENCES public.people(id) ON DELETE CASCADE;


--
-- TOC entry 2845 (class 2606 OID 25116)
-- Name: community_group_people fk_a4810a69c121c60; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.community_group_people
    ADD CONSTRAINT fk_a4810a69c121c60 FOREIGN KEY (community_group_id) REFERENCES public.community_group(id) ON DELETE CASCADE;


--
-- TOC entry 2858 (class 2606 OID 25206)
-- Name: initiative_people fk_b938fd13147c936; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.initiative_people
    ADD CONSTRAINT fk_b938fd13147c936 FOREIGN KEY (people_id) REFERENCES public.people(id) ON DELETE CASCADE;


--
-- TOC entry 2857 (class 2606 OID 25201)
-- Name: initiative_people fk_b938fd1ab7d9771; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.initiative_people
    ADD CONSTRAINT fk_b938fd1ab7d9771 FOREIGN KEY (initiative_id) REFERENCES public.initiative(id) ON DELETE CASCADE;


--
-- TOC entry 2854 (class 2606 OID 25196)
-- Name: initiative fk_e115defe14d45bbe; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.initiative
    ADD CONSTRAINT fk_e115defe14d45bbe FOREIGN KEY (autor_id) REFERENCES public.people(id);


--
-- TOC entry 2855 (class 2606 OID 25238)
-- Name: initiative fk_e115defe59497894; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.initiative
    ADD CONSTRAINT fk_e115defe59497894 FOREIGN KEY (stad_id) REFERENCES public.doc_stad(id);


--
-- TOC entry 2856 (class 2606 OID 25282)
-- Name: initiative fk_e115defec121c60; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.initiative
    ADD CONSTRAINT fk_e115defec121c60 FOREIGN KEY (community_group_id) REFERENCES public.community_group(id);


--
-- TOC entry 2853 (class 2606 OID 25191)
-- Name: initiative fk_e115defee6b66ec9; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.initiative
    ADD CONSTRAINT fk_e115defee6b66ec9 FOREIGN KEY (initiative_type_id) REFERENCES public.petition_type(id);


--
-- TOC entry 2848 (class 2606 OID 25156)
-- Name: petition fk_ff598b0314d45bbe; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.petition
    ADD CONSTRAINT fk_ff598b0314d45bbe FOREIGN KEY (autor_id) REFERENCES public.people(id);


--
-- TOC entry 2847 (class 2606 OID 25151)
-- Name: petition fk_ff598b03547f4ab6; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.petition
    ADD CONSTRAINT fk_ff598b03547f4ab6 FOREIGN KEY (petition_type_id) REFERENCES public.petition_type(id);


--
-- TOC entry 2849 (class 2606 OID 25231)
-- Name: petition fk_ff598b0359497894; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.petition
    ADD CONSTRAINT fk_ff598b0359497894 FOREIGN KEY (stad_id) REFERENCES public.doc_stad(id);


--
-- TOC entry 2850 (class 2606 OID 25288)
-- Name: petition fk_ff598b03c121c60; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.petition
    ADD CONSTRAINT fk_ff598b03c121c60 FOREIGN KEY (community_group_id) REFERENCES public.community_group(id);


-- Completed on 2020-06-06 13:36:10

--
-- PostgreSQL database dump complete
--

